===source===
<?php
fn(): void => 1;
fn(): void => f();
static fn(): void => null;
fn(): void => throw new E;
===errors <=7.4===
A void function must not return a value
A void function must not return a value
A void function must not return a value (did you mean "return;" instead of "return null;"?)
'throw expressions' requires PHP 8.0 or higher
A void function must not return a value
===errors >=8.0===
A void function must not return a value
A void function must not return a value
A void function must not return a value (did you mean "return;" instead of "return null;"?)
A void function must not return a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'throw' (T_THROW) in Standard input code on line 5
===php_error >=8.0===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              },
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 29,
                      "end": 33
                    }
                  }
                },
                "span": {
                  "start": 29,
                  "end": 33
                }
              },
              "body": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 37,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 38
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 37,
                  "end": 40
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 23,
            "end": 40
          }
        }
      },
      "span": {
        "start": 23,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": true,
              "by_ref": false,
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 55,
                      "end": 59
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 59
                }
              },
              "body": {
                "kind": "Null",
                "span": {
                  "start": 63,
                  "end": 67
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 42,
            "end": 67
          }
        }
      },
      "span": {
        "start": 42,
        "end": 68
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 75,
                      "end": 79
                    }
                  }
                },
                "span": {
                  "start": 75,
                  "end": 79
                }
              },
              "body": {
                "kind": {
                  "Throw": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 93,
                                "end": 94
                              }
                            }
                          },
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 94
                    }
                  }
                },
                "span": {
                  "start": 83,
                  "end": 94
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 69,
            "end": 94
          }
        }
      },
      "span": {
        "start": 69,
        "end": 95
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}
