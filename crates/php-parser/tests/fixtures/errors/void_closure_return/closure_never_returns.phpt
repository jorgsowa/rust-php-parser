===source===
<?php
$f = function(): never { return; };
$g = function(): never { if ($a) { return 1; } };
===errors <=8.0===
A function with return type must return a value
===errors >=8.1===
A never-returning function must not return
A never-returning function must not return
===php_error <=8.0===
PHP Fatal error:  A function with return type must return a value in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  A never-returning function must not return in Standard input code on line 2
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "never"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 28
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": null
                        },
                        "span": {
                          "start": 31,
                          "end": 38
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 40
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 42,
                  "end": 44
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "never"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 59,
                            "end": 64
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 64
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "If": {
                            "condition": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 71,
                                "end": 73
                              }
                            },
                            "then_branch": {
                              "kind": {
                                "Block": [
                                  {
                                    "kind": {
                                      "Return": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 84,
                                          "end": 85
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 77,
                                      "end": 86
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 75,
                                "end": 88
                              }
                            },
                            "elseif_branches": [],
                            "else_branch": null
                          }
                        },
                        "span": {
                          "start": 67,
                          "end": 88
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 47,
                  "end": 90
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 90
          }
        }
      },
      "span": {
        "start": 42,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
