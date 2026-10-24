===source===
<?php
function f() {
    continue 2;
}
===errors===
'continue' not in the 'loop' or 'switch' context
===php_error===
PHP Fatal error:  'continue' not in the 'loop' or 'switch' context in Standard input code on line 3
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
          "params": [],
          "body": [
            {
              "kind": {
                "Continue": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 34,
                    "end": 35
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 36
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
