<?php


namespace App\Tests\Unit\Domain;

use App\Domain\FeatureFlag;
use App\Tests\UnitTester;
use Codeception\Test\Unit;

class FeatureFlagTest extends Unit
{

    protected UnitTester $tester;

    public function test_FeatureFlag_constructor_sets_data()
    {
        $featureFlag = new FeatureFlag('test_flag', true);

        expect($featureFlag->getId())->toEqual('test_flag');
        expect($featureFlag->isEnabled())->toBeTrue();
    }

    public function test_FeatureFlag_setName_sets_name()
    {
        $featureFlag = new FeatureFlag('test_flag', true);

        $featureFlag->setId('new_id');

        expect($featureFlag->getId())->toEqual('new_id');
    }

    public function test_FeatureFlag_setEnabled_sets_enabled()
    {
        $featureFlag = new FeatureFlag('test_flag', true);

        $featureFlag->setEnabled(false);

        expect($featureFlag->isEnabled())->toBeFalse();
    }
}
