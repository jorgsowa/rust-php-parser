===source===
<?php
function f() { global $b, $this; }
===errors===
Cannot use $this as global variable
===php_error===
PHP Fatal error:  Cannot use $this as global variable in Standard input code on line 2
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
                "Global": [
                  {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 28,
                      "end": 30
                    }
                  },
                  {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 32,
                      "end": 37
                    }
                  }
                ]
              },
              "span": {
                "start": 21,
                "end": 38
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
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
