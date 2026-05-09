===config===
min_php=8.0

===source===
<?php
function foo(?mixed $x) { }

===errors===
mixed cannot be used with nullable type
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
===php_error===
PHP Fatal error:  Type mixed cannot be marked as nullable since mixed already includes null in Standard input code on line 2
