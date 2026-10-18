===source===
<?php $a?->b()->c(...);
===errors===
Cannot combine nullsafe operator with Closure creation
===php_error===
PHP Fatal error:  Cannot combine nullsafe operator with Closure creation in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Method": {
                  "object": {
                    "kind": {
                      "NullsafeMethodCall": {
                        "object": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 6,
                            "end": 8
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 6,
                      "end": 14
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
