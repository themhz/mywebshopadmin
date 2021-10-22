<?php

/* 
 * Copyright (C) 2021 themhz
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace mywebshop\components\handlers;

use mywebshop\models\User as userModel;
use mywebshop\models\User_paths;
use mywebshop\components\handlers\Request;
use mywebshop\components\interfaces\UserDetails;

class Paths implements UserDetails
{

    public $paths = [];

    public function __construct($user)
    {
        $user_paths = new User_paths();
        $paths =$user_paths->select(['user_id =' => $user->id]);
        foreach($paths as $path){
            $this->paths[] = $path->path;
        }
        
    }
    
    public function validate($path): bool
    {

        $p = explode('/', $path);

        
        if ($p[0] == "admin") {
            if (!isset($p[1]) ||  $p[1] == "")
                $p[1] = 'main';
        
            return in_array($p[1], (array)$this->paths);
        } else {
                       
            return in_array($p[0], (array)$this->paths);
        }
    }

    /**
     * Get the value of paths
     */
    public function get()
    {
        return $this->paths;
    }

    /**
     * Set the value of paths
     *
     * @return  self
     */
    public function set($paths)
    {
        $this->paths = $paths;

        return $this;
    }
}
