<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if ($request->routeIs('users.show')) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this?->role?->name,
                'permissions' => $this->permissions->map(fn ($p) => [
                    'id' => $p->id,
                    'name' => $p->name,
                ]),
                'registered_at' => $this->created_at,
                'profile_updated_at' => $this->updated_at,
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this?->role?->name,
            'permissions' => $this->permissions->pluck('name'),
            'registered_at' => $this->created_at,
            'profile_updated_at' => $this->updated_at,
        ];
    }
}
