===source===
<?php function clone(object $object): object {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "clone",
          "params": [
            {
              "name": "object",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
===php_error===
PHP Parse error:  syntax error, unexpected token "clone", expecting "(" in Standard input code on line 1
