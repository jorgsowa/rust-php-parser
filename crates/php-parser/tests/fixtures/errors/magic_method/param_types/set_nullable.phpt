===source===
<?php
class A {
    function __set(?int $n, string $v) {}
}
===errors >=8.0===
A::__set(): Parameter #1 ($n) must be of type string when declared
===php_error >=8.0===
PHP Fatal error:  A::__set(): Parameter #1 ($n) must be of type string when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 40,
                          "end": 42
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Nullable": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "int"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 36,
                                  "end": 39
                                }
                              }
                            },
                            "span": {
                              "start": 36,
                              "end": 39
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 39
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 42
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 51,
                          "end": 53
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 44,
                              "end": 50
                            }
                          }
                        },
                        "span": {
                          "start": 44,
                          "end": 50
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 53
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
