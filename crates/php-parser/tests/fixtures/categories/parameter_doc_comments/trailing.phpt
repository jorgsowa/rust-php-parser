===source===
<?php
function search(
    string $query /** Terms to search for */,
    string $filter,
) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "search",
          "params": [
            {
              "name": "query",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 27,
                      "end": 33
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 33
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "doc_comment": {
                "kind": "Doc",
                "text": "/** Terms to search for */",
                "span": {
                  "start": 41,
                  "end": 67
                }
              },
              "span": {
                "start": 27,
                "end": 40
              }
            },
            {
              "name": "filter",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 73,
                      "end": 79
                    }
                  }
                },
                "span": {
                  "start": 73,
                  "end": 79
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 73,
                "end": 87
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 93
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93
  }
}
