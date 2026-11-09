===source===
<?php
function f() {
    $f = self::g(...);
}
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use "self" when no class scope is active
===errors >=8.1===
Cannot use "self" when no class scope is active
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
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
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "f"
                        },
                        "span": {
                          "start": 25,
                          "end": 27
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "CallableCreate": {
                            "kind": {
                              "StaticMethod": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "self"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 30,
                                        "end": 34
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 30,
                                    "end": 34
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "g"
                                  },
                                  "span": {
                                    "start": 36,
                                    "end": 37
                                  }
                                }
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 42
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 42
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 43
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
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
