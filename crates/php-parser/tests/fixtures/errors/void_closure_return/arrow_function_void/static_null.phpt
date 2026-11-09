===source===
<?php
static fn(): void => null;
===errors===
A void function must not return a value (did you mean "return;" instead of "return null;"?)
===php_error===
PHP Fatal error:  A void function must not return a value (did you mean "return;" instead of "return null;"?) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": true,
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
                      "start": 19,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 23
                }
              },
              "body": {
                "kind": "Null",
                "span": {
                  "start": 27,
                  "end": 31
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
