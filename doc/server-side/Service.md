Service API Module
---

## Service::**all**
Get the value of a Service objects matching a query

* **URL**: https://www.x4b.net/apiv2/Service/all
* **URL Params**: 

    **query[id]** - int: ID of the Service object (optional for query)

    **page** - optional structure with "start" and "limit" members to page the output

* **Returns**: 
```
[
    {
        "id": "int: ID of the Service object (optional for query)",
        "vanity": "string: the name of the service",
        "type": "not documented",
        "gb_limit": "not documented",
        "user": "not documented",
        "lease": "object: matching the syntax of the Lease module"
    }
]
```
* **Error Response**: 
```
{
    "error": "Error Message"
}
```
