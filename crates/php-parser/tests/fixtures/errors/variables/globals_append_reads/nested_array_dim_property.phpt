===source===
<?php
$x = [[$GLOBALS[]['a']->b]];
===errors===
Cannot use [] for reading
===php_error <=8.0===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Cannot use [] for reading in Standard input code on line 2
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "PropertyAccess": {
                                        "object": {
                                          "kind": {
                                            "ArrayAccess": {
                                              "array": {
                                                "kind": {
                                                  "ArrayAccess": {
                                                    "array": {
                                                      "kind": {
                                                        "Variable": "GLOBALS"
                                                      },
                                                      "span": {
                                                        "start": 13,
                                                        "end": 21
                                                      }
                                                    },
                                                    "index": null
                                                  }
                                                },
                                                "span": {
                                                  "start": 13,
                                                  "end": 23
                                                }
                                              },
                                              "index": {
                                                "kind": {
                                                  "String": "a"
                                                },
                                                "span": {
                                                  "start": 24,
                                                  "end": 27
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 13,
                                            "end": 28
                                          }
                                        },
                                        "property": {
                                          "kind": {
                                            "Identifier": "b"
                                          },
                                          "span": {
                                            "start": 30,
                                            "end": 31
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 31
                                    }
                                  }
                                },
                                "span": {
                                  "start": 13,
                                  "end": 31
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 12,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
