Plan API Module
---

## Plan::**bulk**
method not documented

## Plan::**get**
Get the value of a Plan object matching a query

* **URL**: https://www.x4b.net/apiv2/Plan/get
* **URL Params**: 

    **query[id]** - int: ID of the Plan object (optional for query)

* **Returns**: 
```
{
    "id": "int: ID of the Plan object (optional for query)",
    "name": "string: the name of the plan",
    "gb": "int: the number of GB included in the plan",
    "bill": "string: either PAYG or MONTH",
    "pricing": [
        "An array of pricing information for every region"
    ]
}
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Plan::**all**
Get the value of a Plan objects matching a query

* **URL**: https://www.x4b.net/apiv2/Plan/all
* **URL Params**: 

    **query[id]** - int: ID of the Plan object (optional for query)

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Plan object (optional for query)",
        "name": "string: the name of the plan",
        "gb": "int: the number of GB included in the plan",
        "bill": "string: either PAYG or MONTH",
        "pricing": [
            "An array of pricing information for every region"
        ]
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
## Plan::**describe**
Provides any available description for the Plan API module

* **URL**: https://www.x4b.net/apiv2/Plan/describe
* **URL Params**: 

* **Returns**: this
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
