<?php


namespace App\Tests\Unit\Domain;

use App\Domain\FeatureFlag;
use Codeception\Test\Unit;

class FeatureFlagTest extends Unit
{
    /**
     * @return void
     */
    public function test_FeatureFlag_constructor_sets_data(): void
    {
        $featureFlag = new FeatureFlag('test_flag', true);

        expect($featureFlag->getId())->toEqual('test_flag');
        expect($featureFlag->isEnabled())->toBeTrue();
    }

    /**
     * @return void
     */
    public function test_FeatureFlag_setName_sets_name(): void
    {
        $featureFlag = new FeatureFlag('test_flag', true);

        $featureFlag->setId('new_id');

        expect($featureFlag->getId())->toEqual('new_id');
    }

    /**
     * @return void
     */
    public function test_FeatureFlag_setEnabled_sets_enabled(): void
    {
        $featureFlag = new FeatureFlag('test_flag', true);

        $featureFlag->setEnabled(false);

        expect($featureFlag->isEnabled())->toBeFalse();
    }
}
