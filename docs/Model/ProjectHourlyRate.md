# ProjectHourlyRate

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**project** | [**\Tripletex\Model\Project**](Project.md) |  | [optional] 
**start_date** | **string** |  | 
**show_in_project_order** | **bool** | Show on contract confirmation/offers | [optional] [default to false]
**hourly_rate_model** | **string** | Defines the model used for the hourly rate. | 
**project_specific_rates** | [**\Tripletex\Model\ProjectSpecificRate[]**](ProjectSpecificRate.md) | Project specific rates if hourlyRateModel is TYPE_PROJECT_SPECIFIC_HOURLY_RATES. | [optional] 
**fixed_rate** | **float** | Fixed Hourly rates if hourlyRateModel is TYPE_FIXED_HOURLY_RATE. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

