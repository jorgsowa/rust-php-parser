===source===
<?php
fn($this) => 1;
===errors===
Cannot use $this as parameter
===php_error===
PHP Fatal error:  Cannot use $this as parameter in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": {
                    "name": "this",
                    "span": {
                      "start": 9,
                      "end": 14
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "attributes": [],
                  "span": {
                    "start": 9,
                    "end": 14
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 19,
                  "end": 20
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
