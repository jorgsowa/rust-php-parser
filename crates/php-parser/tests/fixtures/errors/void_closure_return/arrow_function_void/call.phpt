===source===
<?php
fn(): void => f();
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 20,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 21
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 20,
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
