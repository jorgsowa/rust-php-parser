===source===
<?php
namespace N;
$x = new class { function __set(int $n, $v) {} };
===errors >=8.0===
class@anonymous::__set(): Parameter #1 ($n) must be of type string when declared
===php_error >=8.0===
PHP Fatal error:  class@anonymous::__set(): Parameter #1 ($n) must be of type string when declared in Standard input code on line 3
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
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 19,
                  "end": 21
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                      "start": 45,
                                      "end": 50
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [
                                    {
                                      "name": {
                                        "name": "n",
                                        "span": {
                                          "start": 55,
                                          "end": 57
                                        }
                                      },
                                      "type_hint": {
                                        "kind": {
                                          "Named": {
                                            "parts": [
                                              "int"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 51,
                                              "end": 54
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 51,
                                          "end": 54
                                        }
                                      },
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 51,
                                        "end": 57
                                      }
                                    },
                                    {
                                      "name": {
                                        "name": "v",
                                        "span": {
                                          "start": 59,
                                          "end": 61
                                        }
                                      },
                                      "type_hint": null,
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 59,
                                        "end": 61
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 65
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 67
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 24,
                  "end": 67
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 67
          }
        }
      },
      "span": {
        "start": 19,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
