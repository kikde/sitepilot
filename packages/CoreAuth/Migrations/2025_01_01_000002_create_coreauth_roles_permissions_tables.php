<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coreauth_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('coreauth_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('coreauth_tenant_user', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('user_id');
            $table->primary(['tenant_id','user_id']);
            $table->foreign('tenant_id')->references('id')->on('coreauth_tenants')->cascadeOnDelete();
        });

        Schema::create('coreauth_role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('user_id');
            $table->string('role_slug');
            $table->primary(['tenant_id','user_id','role_slug'], 'coreauth_role_user_pk');
            $table->foreign('tenant_id')->references('id')->on('coreauth_tenants')->cascadeOnDelete();
            $table->foreign('role_slug')->references('slug')->on('coreauth_roles')->cascadeOnDelete();
        });

        Schema::create('coreauth_permission_role', function (Blueprint $table) {
            $table->string('permission_slug');
            $table->string('role_slug');
            $table->primary(['permission_slug','role_slug']);
            $table->foreign('permission_slug')->references('slug')->on('coreauth_permissions')->cascadeOnDelete();
            $table->foreign('role_slug')->references('slug')->on('coreauth_roles')->cascadeOnDelete();
        });

        Schema::create('coreauth_permission_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('permission_slug');
            $table->unsignedBigInteger('tenant_id')->nullable();
            // MySQL does not allow NULL columns in PRIMARY KEY.
            // Use a generated key that treats NULL tenant_id as 0 to keep uniqueness semantics.
            $table->unsignedBigInteger('tenant_key')->storedAs('ifnull(`tenant_id`, 0)');
            $table->primary(['user_id', 'permission_slug', 'tenant_key']);
            $table->index('tenant_id');
            $table->foreign('permission_slug')->references('slug')->on('coreauth_permissions')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coreauth_permission_user');
        Schema::dropIfExists('coreauth_permission_role');
        Schema::dropIfExists('coreauth_role_user');
        Schema::dropIfExists('coreauth_tenant_user');
        Schema::dropIfExists('coreauth_permissions');
        Schema::dropIfExists('coreauth_roles');
    }
};
