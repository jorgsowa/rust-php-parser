===source===
<?php
([1] === [2, 3])::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on false
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on false in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 8,
                                      "end": 9
                                    }
                                  }
                                },
                                "span": {
                                  "start": 8,
                                  "end": 9
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 7,
                            "end": 10
                          }
                        },
                        "op": "Identical",
                        "right": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 2
                                    },
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
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 19,
                                      "end": 20
                                    }
                                  }
                                },
                                "span": {
                                  "start": 19,
                                  "end": 20
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 15,
                            "end": 21
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 24,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
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
