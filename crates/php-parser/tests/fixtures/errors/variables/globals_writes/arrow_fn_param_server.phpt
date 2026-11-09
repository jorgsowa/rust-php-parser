===source===
<?php
fn($_SERVER) => 1;
===errors===
Cannot re-assign auto-global variable _SERVER
===php_error===
PHP Fatal error:  Cannot re-assign auto-global variable _SERVER in Standard input code on line 2
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
                    "name": "_SERVER",
                    "span": {
                      "start": 9,
                      "end": 17
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "attributes": [],
                  "span": {
                    "start": 9,
                    "end": 17
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 22,
                  "end": 23
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
