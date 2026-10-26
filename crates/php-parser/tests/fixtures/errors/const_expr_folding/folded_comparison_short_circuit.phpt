===source===
<?php
const A = 1 < 2 && $a;
const B = 'a' . 'b' !== 'ab' || $b;
function f($p = PHP_EOL !== 1 && $c) {}
function g($p = PHP_EOL === 1 && $d) {}
class C {
    const Y = __CLASS__ !== 'C' || $e;
    function m() {
        $g = fn($p = __CLASS__ && $f) => $p;
    }
}
===errors===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
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
                            "Int": 1
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "op": "Less",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 20,
                            "end": 21
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 21
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 25,
                      "end": 27
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 35,
                "end": 36
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
                            "Binary": {
                              "left": {
                                "kind": {
                                  "String": "a"
                                },
                                "span": {
                                  "start": 39,
                                  "end": 42
                                }
                              },
                              "op": "Concat",
                              "right": {
                                "kind": {
                                  "String": "b"
                                },
                                "span": {
                                  "start": 45,
                                  "end": 48
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 39,
                            "end": 48
                          }
                        },
                        "op": "NotIdentical",
                        "right": {
                          "kind": {
                            "String": "ab"
                          },
                          "span": {
                            "start": 53,
                            "end": 57
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 57
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 61,
                      "end": 63
                    }
                  }
                }
              },
              "span": {
                "start": 39,
                "end": 63
              }
            },
            "attributes": [],
            "span": {
              "start": 35,
              "end": 63
            }
          }
        ]
      },
      "span": {
        "start": 29,
        "end": 64
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 74,
              "end": 75
            }
          },
          "params": [
            {
              "name": {
                "name": "p",
                "span": {
                  "start": 76,
                  "end": 78
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "PHP_EOL"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 81,
                                  "end": 88
                                }
                              }
                            },
                            "span": {
                              "start": 81,
                              "end": 88
                            }
                          },
                          "op": "NotIdentical",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 93,
                              "end": 94
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 81,
                        "end": 94
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 98,
                        "end": 100
                      }
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 100
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 76,
                "end": 100
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
        "start": 65,
        "end": 104
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 114,
              "end": 115
            }
          },
          "params": [
            {
              "name": {
                "name": "p",
                "span": {
                  "start": 116,
                  "end": 118
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "PHP_EOL"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 121,
                                  "end": 128
                                }
                              }
                            },
                            "span": {
                              "start": 121,
                              "end": 128
                            }
                          },
                          "op": "Identical",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 133,
                              "end": 134
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 121,
                        "end": 134
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 138,
                        "end": 140
                      }
                    }
                  }
                },
                "span": {
                  "start": 121,
                  "end": 140
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 116,
                "end": 140
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
        "start": 105,
        "end": 144
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 151,
              "end": 152
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
                    "name": "Y",
                    "span": {
                      "start": 165,
                      "end": 166
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
                                  "start": 169,
                                  "end": 178
                                }
                              },
                              "op": "NotIdentical",
                              "right": {
                                "kind": {
                                  "String": "C"
                                },
                                "span": {
                                  "start": 183,
                                  "end": 186
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 169,
                            "end": 186
                          }
                        },
                        "op": "BooleanOr",
                        "right": {
                          "kind": {
                            "Variable": "e"
                          },
                          "span": {
                            "start": 190,
                            "end": 192
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 169,
                      "end": 192
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 193
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 207,
                      "end": 208
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
                                  "start": 221,
                                  "end": 223
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
                                            "start": 229,
                                            "end": 231
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
                                                  "start": 234,
                                                  "end": 243
                                                }
                                              },
                                              "op": "BooleanAnd",
                                              "right": {
                                                "kind": {
                                                  "Variable": "f"
                                                },
                                                "span": {
                                                  "start": 247,
                                                  "end": 249
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 234,
                                            "end": 249
                                          }
                                        },
                                        "by_ref": false,
                                        "variadic": false,
                                        "attributes": [],
                                        "span": {
                                          "start": 229,
                                          "end": 249
                                        }
                                      }
                                    ],
                                    "return_type": null,
                                    "body": {
                                      "kind": {
                                        "Variable": "p"
                                      },
                                      "span": {
                                        "start": 254,
                                        "end": 256
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 226,
                                  "end": 256
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 221,
                            "end": 256
                          }
                        }
                      },
                      "span": {
                        "start": 221,
                        "end": 257
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 198,
                "end": 263
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 145,
        "end": 265
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 265
  }
}
