===source===
<?php
class C {
    function f() {
        $g = function ($p = __CLASS__ ? 1 : $a) {};
        $h = fn($p = __CLASS__ ?: $a) => $p;
        $i = static function ($p = __CLASS__ ?? $a) {};
        return new class {
            function f() {
                return function ($p = __CLASS__ ? 1 : $a) {};
            }
        };
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "f",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
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
                                  "start": 43,
                                  "end": 45
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
                                            "start": 58,
                                            "end": 60
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
                                                  "start": 63,
                                                  "end": 72
                                                }
                                              },
                                              "then_expr": {
                                                "kind": {
                                                  "Int": 1
                                                },
                                                "span": {
                                                  "start": 75,
                                                  "end": 76
                                                }
                                              },
                                              "else_expr": {
                                                "kind": {
                                                  "Variable": "a"
                                                },
                                                "span": {
                                                  "start": 79,
                                                  "end": 81
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 63,
                                            "end": 81
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 58,
                                          "end": 81
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
                                  "start": 48,
                                  "end": 85
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 85
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 86
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "h"
                                },
                                "span": {
                                  "start": 95,
                                  "end": 97
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
                                            "start": 103,
                                            "end": 105
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
                                                  "start": 108,
                                                  "end": 117
                                                }
                                              },
                                              "then_expr": null,
                                              "else_expr": {
                                                "kind": {
                                                  "Variable": "a"
                                                },
                                                "span": {
                                                  "start": 121,
                                                  "end": 123
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 108,
                                            "end": 123
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 103,
                                          "end": 123
                                        }
                                      }
                                    ],
                                    "return_type": null,
                                    "body": {
                                      "kind": {
                                        "Variable": "p"
                                      },
                                      "span": {
                                        "start": 128,
                                        "end": 130
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 100,
                                  "end": 130
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 95,
                            "end": 130
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 131
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "i"
                                },
                                "span": {
                                  "start": 140,
                                  "end": 142
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Closure": {
                                    "is_static": true,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": {
                                          "name": "p",
                                          "span": {
                                            "start": 162,
                                            "end": 164
                                          }
                                        },
                                        "type_hint": null,
                                        "default": {
                                          "kind": {
                                            "NullCoalesce": {
                                              "left": {
                                                "kind": {
                                                  "MagicConst": "Class"
                                                },
                                                "span": {
                                                  "start": 167,
                                                  "end": 176
                                                }
                                              },
                                              "right": {
                                                "kind": {
                                                  "Variable": "a"
                                                },
                                                "span": {
                                                  "start": 180,
                                                  "end": 182
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 167,
                                            "end": 182
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 162,
                                          "end": 182
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
                                  "start": 145,
                                  "end": 186
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 140,
                            "end": 186
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 187
                      }
                    },
                    {
                      "kind": {
                        "Return": {
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
                                              "name": "f",
                                              "span": {
                                                "start": 236,
                                                "end": 237
                                              }
                                            },
                                            "by_ref": false,
                                            "params": [],
                                            "return_type": null,
                                            "body": [
                                              {
                                                "kind": {
                                                  "Return": {
                                                    "kind": {
                                                      "Closure": {
                                                        "is_static": false,
                                                        "by_ref": false,
                                                        "params": [
                                                          {
                                                            "name": {
                                                              "name": "p",
                                                              "span": {
                                                                "start": 275,
                                                                "end": 277
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
                                                                      "start": 280,
                                                                      "end": 289
                                                                    }
                                                                  },
                                                                  "then_expr": {
                                                                    "kind": {
                                                                      "Int": 1
                                                                    },
                                                                    "span": {
                                                                      "start": 292,
                                                                      "end": 293
                                                                    }
                                                                  },
                                                                  "else_expr": {
                                                                    "kind": {
                                                                      "Variable": "a"
                                                                    },
                                                                    "span": {
                                                                      "start": 296,
                                                                      "end": 298
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 280,
                                                                "end": 298
                                                              }
                                                            },
                                                            "by_ref": false,
                                                            "variadic": false,
                                                            "attributes": [],
                                                            "span": {
                                                              "start": 275,
                                                              "end": 298
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
                                                      "start": 265,
                                                      "end": 302
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 258,
                                                  "end": 303
                                                }
                                              }
                                            ],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 227,
                                          "end": 317
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 203,
                                  "end": 327
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 203,
                            "end": 327
                          }
                        }
                      },
                      "span": {
                        "start": 196,
                        "end": 328
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 334
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 336
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 336
  }
}
