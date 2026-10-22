===source===
<?php
function foo(?mixed $x) { }

===errors <=7.4===
'mixed type' requires PHP 8.0 or higher
===errors >=8.0===
Type mixed cannot be marked as nullable since mixed already includes null
===php_error >=8.0===
PHP Fatal error:  Type mixed cannot be marked as nullable since mixed already includes null in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "mixed"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 20,
                          "end": 25
                        }
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 25
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 28
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
