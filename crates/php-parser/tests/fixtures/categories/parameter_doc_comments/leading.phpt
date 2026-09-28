===source===
<?php
function search(
    /** Terms to search for */
    string $query,
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
                      "start": 58,
                      "end": 64
                    }
                  }
                },
                "span": {
                  "start": 58,
                  "end": 64
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
                  "start": 27,
                  "end": 53
                }
              },
              "span": {
                "start": 58,
                "end": 71
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
                      "start": 77,
                      "end": 83
                    }
                  }
                },
                "span": {
                  "start": 77,
                  "end": 83
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
                "start": 77,
                "end": 91
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
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
