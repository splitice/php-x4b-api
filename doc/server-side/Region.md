Region API Module
---

## Region::**bulk**
method not documented

## Region::**get**
Get the value of a Region object matching a query

* **URL**: https://www.x4b.net/apiv2/Region/get
* **URL Params**: 

    **query[id]** - int: ID of the Region object (optional for query)

* **Returns**: 
```
{
    "id": "int: ID of the Region object (optional for query)",
    "name": "string: the name of the region"
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Region::**all**
Get the value of a Region objects matching a query

* **URL**: https://www.x4b.net/apiv2/Region/all
* **URL Params**: 

    **query[id]** - int: ID of the Region object (optional for query)

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Region object (optional for query)",
        "name": "string: the name of the region"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Region::**describe**
Provides any available description for the Region API module

* **URL**: https://www.x4b.net/apiv2/Region/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
