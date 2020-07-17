<?php
// Copyright 2004-present Facebook. All Rights Reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

namespace Facebook\WebDriver;

interface WebDriverCapabilities
{
    /**
     * @return string The name of the browser.
     */
    public function getBrowserName();

    /**
     * @param string $name
     * @return mixed The value of a capability.
     */
    public function getCapability($name);

    /**
     * @return string The name of the platform.
     */
    public function getPlatform();

    /**
     * @return string The version of the browser.
     */
    public function getVersion();

    /**
     * @param string $capability_name
     * @return bool Whether the value is not null and not false.
     */
    public function is($capability_name);

    /**
     * @todo Remove in next major release (BC)
     * @deprecated All browsers are always JS enabled except HtmlUnit and it's not meaningful to disable JS execution.
     * @return bool Whether javascript is enabled.
     */
    public function isJavascriptEnabled();

    // TODO: Add in next major release (BC)
    ///**
    // * @return array
    // */
    //public function toArray();
}
