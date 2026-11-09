===source===
<?php
$o->m(a: $GLOBALS[]);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
===errors >=8.1===
Cannot append to $GLOBALS
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 13
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 15,
                              "end": 23
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 25
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
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
