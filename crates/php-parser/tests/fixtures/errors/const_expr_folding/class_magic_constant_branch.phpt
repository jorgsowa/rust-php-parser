===source===
<?php
namespace N;
class C {
    const X = __CLASS__ ? $a : 1;
    function m($p = __CLASS__ ? $c : 1) {
        $f = function ($p = __CLASS__ ? $d : 1) {};
        $g = fn($p = __CLASS__ ? $f : 1) => $p;
        function inner($p = __CLASS__ ? 1 : $e) {}
    }
}
===errors===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 4
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
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 25,
              "end": 26
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "value": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "MagicConst": "Class"
                          },
                          "span": {
                            "start": 43,
                            "end": 52
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 55,
                            "end": 57
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 60,
                            "end": 61
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 61
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 62
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 76,
                      "end": 77
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "p",
                        "span": {
                          "start": 78,
                          "end": 80
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "MagicConst": "Class"
                              },
                              "span": {
                                "start": 83,
                                "end": 92
                              }
                            },
                            "then_expr": {
                              "kind": {
                                "Variable": "c"
                              },
                              "span": {
                                "start": 95,
                                "end": 97
                              }
                            },
                            "else_expr": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 100,
                                "end": 101
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 83,
                          "end": 101
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 78,
                        "end": 101
                      }
                    }
                  ],
                  "return_type": null,
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
                                  "start": 113,
                                  "end": 115
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Closure": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": {
                                          "name": "p",
                                          "span": {
                                            "start": 128,
                                            "end": 130
                                          }
                                        },
                                        "type_hint": null,
                                        "default": {
                                          "kind": {
                                            "Ternary": {
                                              "condition": {
                                                "kind": {
                                                  "MagicConst": "Class"
                                                },
                                                "span": {
                                                  "start": 133,
                                                  "end": 142
                                                }
                                              },
                                              "then_expr": {
                                                "kind": {
                                                  "Variable": "d"
                                                },
                                                "span": {
                                                  "start": 145,
                                                  "end": 147
                                                }
                                              },
                                              "else_expr": {
                                                "kind": {
                                                  "Int": 1
                                                },
                                                "span": {
                                                  "start": 150,
                                                  "end": 151
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 133,
                                            "end": 151
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 128,
                                          "end": 151
                                        }
                                      }
                                    ],
                                    "use_vars": [],
                                    "return_type": null,
                                    "body": [],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 118,
                                  "end": 155
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 113,
                            "end": 155
                          }
                        }
                      },
                      "span": {
                        "start": 113,
                        "end": 156
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
                                  "start": 165,
                                  "end": 167
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "ArrowFunction": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": {
                                          "name": "p",
                                          "span": {
                                            "start": 173,
                                            "end": 175
                                          }
                                        },
                                        "type_hint": null,
                                        "default": {
                                          "kind": {
                                            "Ternary": {
                                              "condition": {
                                                "kind": {
                                                  "MagicConst": "Class"
                                                },
                                                "span": {
                                                  "start": 178,
                                                  "end": 187
                                                }
                                              },
                                              "then_expr": {
                                                "kind": {
                                                  "Variable": "f"
                                                },
                                                "span": {
                                                  "start": 190,
                                                  "end": 192
                                                }
                                              },
                                              "else_expr": {
                                                "kind": {
                                                  "Int": 1
                                                },
                                                "span": {
                                                  "start": 195,
                                                  "end": 196
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 178,
                                            "end": 196
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 173,
                                          "end": 196
                                        }
                                      }
                                    ],
                                    "return_type": null,
                                    "body": {
                                      "kind": {
                                        "Variable": "p"
                                      },
                                      "span": {
                                        "start": 201,
                                        "end": 203
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 170,
                                  "end": 203
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 165,
                            "end": 203
                          }
                        }
                      },
                      "span": {
                        "start": 165,
                        "end": 204
                      }
                    },
                    {
                      "kind": {
                        "Function": {
                          "name": {
                            "name": "inner",
                            "span": {
                              "start": 222,
                              "end": 227
                            }
                          },
                          "params": [
                            {
                              "name": {
                                "name": "p",
                                "span": {
                                  "start": 228,
                                  "end": 230
                                }
                              },
                              "type_hint": null,
                              "default": {
                                "kind": {
                                  "Ternary": {
                                    "condition": {
                                      "kind": {
                                        "MagicConst": "Class"
                                      },
                                      "span": {
                                        "start": 233,
                                        "end": 242
                                      }
                                    },
                                    "then_expr": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 245,
                                        "end": 246
                                      }
                                    },
                                    "else_expr": {
                                      "kind": {
                                        "Variable": "e"
                                      },
                                      "span": {
                                        "start": 249,
                                        "end": 251
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 233,
                                  "end": 251
                                }
                              },
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 228,
                                "end": 251
                              }
                            }
                          ],
                          "body": [],
                          "return_type": null,
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 213,
                        "end": 255
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 67,
                "end": 261
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 263
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 263
  }
}
