# Activity

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**version** | **int** |  | [optional] 
**changes** | [**\Tripletex\Model\Change[]**](Change.md) |  | [optional] 
**url** | **string** |  | [optional] 
**name** | **string** |  | [optional] 
**number** | **string** |  | [optional] 
**description** | **string** |  | [optional] 
**activity_type** | **string** | PROJECT_SPECIFIC_ACTIVITY are made via project/projectactivity, as they must be part of a project. | [optional] 
**is_project_activity** | **bool** | Manipulate these with ActivityType | [optional] [default to false]
**is_general** | **bool** | Manipulate these with ActivityType | [optional] [default to false]
**is_task** | **bool** | Manipulate these with ActivityType | [optional] [default to false]
**is_chargeable** | **bool** |  | [optional] [default to false]
**rate** | **float** |  | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

