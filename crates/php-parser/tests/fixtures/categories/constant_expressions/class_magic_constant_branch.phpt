===source===
<?php
namespace N;
function f($p = __CLASS__ ? $a : 1) {}
class C {
    const X = __CLASS__ ? 1 : $a;
    const Y = __CLASS__ === 'N\C' || $b;
    function m($p = __CLASS__ ?: $c) {
        $f = function ($p = __CLASS__ ? 1 : $d) {};
        $g = fn($p = __CLASS__ || $e) => $p;
        function inner($p = __CLASS__ ? $f : 1) {}
    }
}
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
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 28,
              "end": 29
            }
          },
          "params": [
            {
              "name": {
                "name": "p",
                "span": {
                  "start": 30,
                  "end": 32
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
                        "start": 35,
                        "end": 44
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 47,
                        "end": 49
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 53
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 30,
                "end": 53
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
        "start": 19,
        "end": 57
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 64,
              "end": 65
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
                      "start": 78,
                      "end": 79
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
                            "start": 82,
                            "end": 91
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 94,
                            "end": 95
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 98,
                            "end": 100
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 100
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 72,
                "end": 101
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 112,
                      "end": 113
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "MagicConst": "Class"
                                },
                                "span": {
                                  "start": 116,
                                  "end": 125
                                }
                              },
                              "op": "Identical",
                              "right": {
                                "kind": {
                                  "String": "N\\C"
                                },
                                "span": {
                                  "start": 130,
                                  "end": 135
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 116,
                            "end": 135
                          }
                        },
                        "op": "BooleanOr",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 139,
                            "end": 141
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 116,
                      "end": 141
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 106,
                "end": 142
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 156,
                      "end": 157
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "p",
                        "span": {
                          "start": 158,
                          "end": 160
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
                                "start": 163,
                                "end": 172
                              }
                            },
                            "then_expr": null,
                            "else_expr": {
                              "kind": {
                                "Variable": "c"
                              },
                              "span": {
                                "start": 176,
                                "end": 178
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 163,
                          "end": 178
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 158,
                        "end": 178
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
                                  "start": 190,
                                  "end": 192
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
                                            "start": 205,
                                            "end": 207
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
                                                  "start": 210,
                                                  "end": 219
                                                }
                                              },
                                              "then_expr": {
                                                "kind": {
                                                  "Int": 1
                                                },
                                                "span": {
                                                  "start": 222,
                                                  "end": 223
                                                }
                                              },
                                              "else_expr": {
                                                "kind": {
                                                  "Variable": "d"
                                                },
                                                "span": {
                                                  "start": 226,
                                                  "end": 228
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 210,
                                            "end": 228
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 205,
                                          "end": 228
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
                                  "start": 195,
                                  "end": 232
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 190,
                            "end": 232
                          }
                        }
                      },
                      "span": {
                        "start": 190,
                        "end": 233
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
                                  "start": 242,
                                  "end": 244
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
                                            "start": 250,
                                            "end": 252
                                          }
                                        },
                                        "type_hint": null,
                                        "default": {
                                          "kind": {
                                            "Binary": {
                                              "left": {
                                                "kind": {
                                                  "MagicConst": "Class"
                                                },
                                                "span": {
                                                  "start": 255,
                                                  "end": 264
                                                }
                                              },
                                              "op": "BooleanOr",
                                              "right": {
                                                "kind": {
                                                  "Variable": "e"
                                                },
                                                "span": {
                                                  "start": 268,
                                                  "end": 270
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 255,
                                            "end": 270
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 250,
                                          "end": 270
                                        }
                                      }
                                    ],
                                    "return_type": null,
                                    "body": {
                                      "kind": {
                                        "Variable": "p"
                                      },
                                      "span": {
                                        "start": 275,
                                        "end": 277
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 247,
                                  "end": 277
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 242,
                            "end": 277
                          }
                        }
                      },
                      "span": {
                        "start": 242,
                        "end": 278
                      }
                    },
                    {
                      "kind": {
                        "Function": {
                          "name": {
                            "name": "inner",
                            "span": {
                              "start": 296,
                              "end": 301
                            }
                          },
                          "params": [
                            {
                              "name": {
                                "name": "p",
                                "span": {
                                  "start": 302,
                                  "end": 304
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
                                        "start": 307,
                                        "end": 316
                                      }
                                    },
                                    "then_expr": {
                                      "kind": {
                                        "Variable": "f"
                                      },
                                      "span": {
                                        "start": 319,
                                        "end": 321
                                      }
                                    },
                                    "else_expr": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 324,
                                        "end": 325
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 307,
                                  "end": 325
                                }
                              },
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 302,
                                "end": 325
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
                        "start": 287,
                        "end": 329
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 147,
                "end": 335
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 58,
        "end": 337
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 337
  }
}
