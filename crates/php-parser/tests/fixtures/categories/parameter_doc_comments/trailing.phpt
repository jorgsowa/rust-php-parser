===source===
<?php
function search(
    string $query /** Terms to search for */,
    string $filter,
) {}
===errors <=7.4===
'trailing comma in parameter list' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting variable (T_VARIABLE) in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "search",
            "span": {
              "start": 15,
              "end": 21
            }
          },
          "params": [
            {
              "name": {
                "name": "query",
                "span": {
                  "start": 34,
                  "end": 40
                }
              },
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
              "name": {
                "name": "filter",
                "span": {
                  "start": 80,
                  "end": 87
                }
              },
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
