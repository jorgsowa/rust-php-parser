===source===
<?php
namespace N;
trait T { function __get() {} }
===errors===
Method N\T::__get() must take exactly 1 argument
===php_error===
PHP Fatal error:  Method N\T::__get() must take exactly 1 argument in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 25,
              "end": 26
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 38,
                      "end": 43
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
