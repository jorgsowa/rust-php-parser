===source===
<?php
function f(...$_SESSION) {}
===errors===
Cannot re-assign auto-global variable _SESSION
===php_error===
PHP Fatal error:  Cannot re-assign auto-global variable _SESSION in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "_SESSION",
                "span": {
                  "start": 20,
                  "end": 29
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 29
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
