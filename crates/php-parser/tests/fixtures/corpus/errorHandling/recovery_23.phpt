===source===
<?php
$array = [
    $this->value $oopsAnotherValue->get()
];
$array = [
    $value $oopsAnotherValue
];
$array = [
    'key' => $value $oopsAnotherValue
];
===errors===
expected ']', found variable
expected ';' after expression
expected ';' after expression
expected expression
expected ']', found variable
expected ';' after expression
expected ';' after expression
expected expression
expected ']', found variable
expected ';' after expression
expected ';' after expression
expected expression
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
                  "Variable": "array"
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "this"
                              },
                              "span": {
                                "start": 21,
                                "end": 26
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "value"
                              },
                              "span": {
                                "start": 28,
                                "end": 33
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 33
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 21,
                        "end": 33
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
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
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "oopsAnotherValue"
                },
                "span": {
                  "start": 34,
                  "end": 51
                }
              },
              "method": {
                "kind": {
                  "Identifier": "get"
                },
                "span": {
                  "start": 53,
                  "end": 56
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 34,
            "end": 58
          }
        }
      },
      "span": {
        "start": 34,
        "end": 58
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 59,
        "end": 61
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "array"
                },
                "span": {
                  "start": 62,
                  "end": 68
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 77,
                          "end": 83
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 77,
                        "end": 83
                      }
                    }
                  ]
                },
                "span": {
                  "start": 71,
                  "end": 83
                }
              }
            }
          },
          "span": {
            "start": 62,
            "end": 83
          }
        }
      },
      "span": {
        "start": 62,
        "end": 83
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "oopsAnotherValue"
          },
          "span": {
            "start": 84,
            "end": 101
          }
        }
      },
      "span": {
        "start": 84,
        "end": 101
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 102,
        "end": 104
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "array"
                },
                "span": {
                  "start": 105,
                  "end": 111
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "key"
                        },
                        "span": {
                          "start": 120,
                          "end": 125
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 129,
                          "end": 135
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 120,
                        "end": 135
                      }
                    }
                  ]
                },
                "span": {
                  "start": 114,
                  "end": 135
                }
              }
            }
          },
          "span": {
            "start": 105,
            "end": 135
          }
        }
      },
      "span": {
        "start": 105,
        "end": 135
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "oopsAnotherValue"
          },
          "span": {
            "start": 136,
            "end": 153
          }
        }
      },
      "span": {
        "start": 136,
        "end": 153
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 154,
        "end": 156
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 156
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected variable "$oopsAnotherValue", expecting "]" in Standard input code on line 3
