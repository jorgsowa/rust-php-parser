===source===
<?php
const J = E::A->value();
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Constant expression contains invalid operations
===errors >=8.0===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting ';' or ',' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "J",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "MethodCall": {
                  "object": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 16,
                                "end": 17
                              }
                            }
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 22,
                      "end": 27
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
