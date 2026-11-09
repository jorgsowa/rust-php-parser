===source===
<?php
function f() { static $c, $this; }
===errors===
Cannot use $this as static variable
===php_error===
PHP Fatal error:  Cannot use $this as static variable in Standard input code on line 2
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
                "StaticVar": [
                  {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 28,
                        "end": 30
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 28,
                      "end": 30
                    }
                  },
                  {
                    "name": {
                      "name": "this",
                      "span": {
                        "start": 32,
                        "end": 37
                      }
                    },
                    "default": null,
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
