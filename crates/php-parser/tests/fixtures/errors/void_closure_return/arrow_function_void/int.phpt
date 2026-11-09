===source===
<?php
fn(): void => 1;
===errors===
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
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
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              },
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
