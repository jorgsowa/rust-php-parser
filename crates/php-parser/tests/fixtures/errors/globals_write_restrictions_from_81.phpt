===source===
<?php
$GLOBALS = [];
$a = &$GLOBALS;
unset($GLOBALS);
$GLOBALS += [1];
[$GLOBALS] = [1];
foreach ($a as $GLOBALS) {}
$GLOBALS++;
$GLOBALS[] = 1;
$b = &$GLOBALS[];
===errors >=8.1===
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
Cannot acquire reference to $GLOBALS
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
Cannot append to $GLOBALS
Cannot append to $GLOBALS
===php_error >=8.1===
PHP Fatal error:  $GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax in Standard input code on line 2
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 17,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 21,
                  "end": 23
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 27,
                  "end": 35
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 21,
            "end": 35
          }
        }
      },
      "span": {
        "start": 21,
        "end": 36
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "GLOBALS"
            },
            "span": {
              "start": 43,
              "end": 51
            }
          }
        ]
      },
      "span": {
        "start": 37,
        "end": 53
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 54,
                  "end": 62
                }
              },
              "op": "Plus",
              "value": {
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
                            "start": 67,
                            "end": 68
                          }
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 68
                      }
                    }
                  ]
                },
                "span": {
                  "start": 66,
                  "end": 69
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 69
          }
        }
      },
      "span": {
        "start": 54,
        "end": 70
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 72,
                            "end": 80
                          }
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 80
                      }
                    }
                  ]
                },
                "span": {
                  "start": 71,
                  "end": 81
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
                            "Int": 1
                          },
                          "span": {
                            "start": 85,
                            "end": 86
                          }
                        }
                      },
                      "span": {
                        "start": 85,
                        "end": 86
                      }
                    }
                  ]
                },
                "span": {
                  "start": 84,
                  "end": 87
                }
              }
            }
          },
          "span": {
            "start": 71,
            "end": 87
          }
        }
      },
      "span": {
        "start": 71,
        "end": 88
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 98,
              "end": 100
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "GLOBALS"
            },
            "span": {
              "start": 104,
              "end": 112
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 114,
              "end": 116
            }
          }
        }
      },
      "span": {
        "start": 89,
        "end": 116
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 117,
                  "end": 125
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 117,
            "end": 127
          }
        }
      },
      "span": {
        "start": 117,
        "end": 128
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 129,
                        "end": 137
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 129,
                  "end": 139
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 142,
                  "end": 143
                }
              }
            }
          },
          "span": {
            "start": 129,
            "end": 143
          }
        }
      },
      "span": {
        "start": 129,
        "end": 144
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 145,
                  "end": 147
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 151,
                        "end": 159
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 151,
                  "end": 161
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 145,
            "end": 161
          }
        }
      },
      "span": {
        "start": 145,
        "end": 162
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 162
  }
}
