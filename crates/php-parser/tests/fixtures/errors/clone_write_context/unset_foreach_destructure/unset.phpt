===source===
<?php
unset((clone $a)->b);
===errors <=8.4===
Cannot use temporary expression in write context
===errors >=8.5===
Cannot use result of built-in function in write context
===php_error <=8.4===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Clone": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 19,
                            "end": 21
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 21
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 22
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "b"
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                }
              }
            },
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
