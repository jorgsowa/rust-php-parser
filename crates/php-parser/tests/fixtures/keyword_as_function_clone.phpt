===source===
<?php function clone(object $object): object {}
===errors===
cannot use 'clone' as function name; it is reserved
===php_error===
PHP Parse error:  syntax error, unexpected token "clone", expecting "(" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "clone",
            "span": {
              "start": 15,
              "end": 20
            }
          },
          "params": [
            {
              "name": {
                "name": "object",
                "span": {
                  "start": 28,
                  "end": 35
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 27
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 35
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "object"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 38,
                  "end": 44
                }
              }
            },
            "span": {
              "start": 38,
              "end": 44
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
