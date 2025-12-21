# manifest-creator.ps1
# Run this script from inside the "fonts" folder.
# It creates/overwrites fonts\manifest.json listing all fonts with src starting "fonts/...".

$ErrorActionPreference = 'Stop'

# -------------------- CONFIG --------------------
# Prefix used in the manifest `src` field so your HTML can request /fonts/...
# If your HTML lives elsewhere, change to '/assets/fonts/' or './fonts/' etc.
$WebPrefix = 'fonts/'

# Extensions to include
$exts = @('.woff2', '.woff', '.ttf', '.otf')
# ------------------------------------------------

# Root = current directory (the fonts folder)
$root = (Get-Location).Path

function Infer-Weight([string]$n) {
  $n = $n.ToLower()
  if     ($n -match 'thin(?!.*(extra|ultra))')      { return 100 }
  elseif ($n -match '(extra|ultra)[-_ ]*light')     { return 200 }
  elseif ($n -match '\blight\b')                    { return 300 }
  elseif ($n -match '\b(regular|book|roman|normal)\b') { return 400 }
  elseif ($n -match '\bmedium\b')                   { return 500 }
  elseif ($n -match '(semi|demi)[-_ ]*bold')        { return 600 }
  elseif ($n -match '(extra|ultra)[-_ ]*bold')      { return 800 }
  elseif ($n -match '\bbold\b')                     { return 700 }  # checked after extra/ultra bold
  elseif ($n -match '(black|heavy)')                { return 900 }
  else                                              { return 400 }
}

function Infer-Style([string]$n) {
  $n = $n.ToLower()
  if ($n -match '(italic|oblique)') { return 'italic' }
  else                              { return 'normal' }
}

function Infer-Family([System.IO.FileInfo]$f) {
  # Prefer parent folder as family
  $rel = $f.FullName.Substring($root.Length).TrimStart('\')
  $parts = $rel -split '\\'
  if ($parts.Length -ge 2) {
    $folder = $parts[$parts.Length - 2].Trim()
    if ($folder) { return $folder }
  }
  # Fallback to filename stem before first - or _
  $stem = [System.IO.Path]::GetFileNameWithoutExtension($f.Name)
  return ($stem -split '[-_]')[0].Trim()
}

$files = Get-ChildItem -LiteralPath $root -Recurse -File |
         Where-Object { $exts -contains $_.Extension.ToLower() }

$out = @()

foreach ($f in $files) {
  # Path *inside* the fonts folder (forward slashes)
  $relInsideFonts = $f.FullName.Substring($root.Length).TrimStart('\') -replace '\\', '/'
  # Final URL that HTML should request
  $src = ('{0}{1}' -f $WebPrefix, $relInsideFonts)

  $family  = Infer-Family $f
  $weight  = Infer-Weight $f.Name
  $style   = Infer-Style  $f.Name
  $format  = $f.Extension.TrimStart('.').ToLower()

  $out += [pscustomobject]@{
    family = $family
    src    = $src
    weight = $weight
    style  = $style
    format = $format
  }
}

# Sort for consistency
$out = $out | Sort-Object family, weight, style, src

# Write JSON (UTF-8)
$dest = Join-Path $root 'manifest.json'
$json = $out | ConvertTo-Json -Depth 4
[System.IO.File]::WriteAllText($dest, $json, [System.Text.Encoding]::UTF8)

Write-Host "manifest.json written to: $dest"
Write-Host "Example src in manifest: $($out[0].src)"
