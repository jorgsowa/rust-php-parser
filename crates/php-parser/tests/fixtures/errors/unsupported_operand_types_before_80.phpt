===source===
<?php
function f() {
    return [1, 2] + 1;
}
const A = [] - 1;
$a = -[];
$b = ~null;
$c = ([] + []) * 2;
$d = [] / "1e3";
$f = ~!2;
if (false) {
    $e = ~true;
}
===errors <=7.4===
Unsupported operand types
Unsupported operand types
Unsupported operand types
Unsupported operand types
Unsupported operand types
Unsupported operand types
Unsupported operand types
Unsupported operand types
===php_error <=7.4===
PHP Fatal error:  Unsupported operand types in Standard input code on line 3
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
                "Return": {
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
                                    "start": 33,
                                    "end": 34
                                  }
                                }
                              },
                              "span": {
                                "start": 33,
                                "end": 34
                              }
                            },
                            {
                              "key": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 36,
                                    "end": 37
                                  }
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 37
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 32,
                          "end": 38
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 41,
                          "end": 42
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 32,
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
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 52,
                "end": 53
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 56,
                      "end": 58
                    }
                  },
                  "op": "Sub",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 61,
                      "end": 62
                    }
                  }
                }
              },
              "span": {
                "start": 56,
                "end": 62
              }
            },
            "attributes": [],
            "span": {
              "start": 52,
              "end": 62
            }
          }
        ]
      },
      "span": {
        "start": 46,
        "end": 63
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
                  "start": 64,
                  "end": 66
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 70,
                        "end": 72
                      }
                    }
                  }
                },
                "span": {
                  "start": 69,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 64,
            "end": 72
          }
        }
      },
      "span": {
        "start": 64,
        "end": 73
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
                  "start": 74,
                  "end": 76
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BitwiseNot",
                    "operand": {
                      "kind": "Null",
                      "span": {
                        "start": 80,
                        "end": 84
                      }
                    }
                  }
                },
                "span": {
                  "start": 79,
                  "end": 84
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 84
          }
        }
      },
      "span": {
        "start": 74,
        "end": 85
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 86,
                  "end": 88
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Array": []
                                },
                                "span": {
                                  "start": 92,
                                  "end": 94
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Array": []
                                },
                                "span": {
                                  "start": 97,
                                  "end": 99
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 99
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 100
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 103,
                        "end": 104
                      }
                    }
                  }
                },
                "span": {
                  "start": 91,
                  "end": 104
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 104
          }
        }
      },
      "span": {
        "start": 86,
        "end": 105
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 106,
                  "end": 108
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 111,
                        "end": 113
                      }
                    },
                    "op": "Div",
                    "right": {
                      "kind": {
                        "String": "1e3"
                      },
                      "span": {
                        "start": 116,
                        "end": 121
                      }
                    }
                  }
                },
                "span": {
                  "start": 111,
                  "end": 121
                }
              }
            }
          },
          "span": {
            "start": 106,
            "end": 121
          }
        }
      },
      "span": {
        "start": 106,
        "end": 122
      }
    },
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
                  "start": 123,
                  "end": 125
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BitwiseNot",
                    "operand": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 130,
                              "end": 131
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 129,
                        "end": 131
                      }
                    }
                  }
                },
                "span": {
                  "start": 128,
                  "end": 131
                }
              }
            }
          },
          "span": {
            "start": 123,
            "end": 131
          }
        }
      },
      "span": {
        "start": 123,
        "end": 132
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": false
            },
            "span": {
              "start": 137,
              "end": 142
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "e"
                            },
                            "span": {
                              "start": 150,
                              "end": 152
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "UnaryPrefix": {
                                "op": "BitwiseNot",
                                "operand": {
                                  "kind": {
                                    "Bool": true
                                  },
                                  "span": {
                                    "start": 156,
                                    "end": 160
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 155,
                              "end": 160
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 150,
                        "end": 160
                      }
                    }
                  },
                  "span": {
                    "start": 150,
                    "end": 161
                  }
                }
              ]
            },
            "span": {
              "start": 144,
              "end": 163
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 133,
        "end": 163
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163
  }
}
