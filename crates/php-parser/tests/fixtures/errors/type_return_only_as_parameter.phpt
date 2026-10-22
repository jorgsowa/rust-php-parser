===source===
<?php
function a(void $a, never ...$b) {}
$c = function (void $c) {};
$d = fn(never $d) => 1;
class C {
    public function __construct(public void $e) {}
    public function m(int $f, void &$g) {}
}
===errors <=7.4===
void cannot be used as a parameter type
void cannot be used as a parameter type
'constructor property promotion' requires PHP 8.0 or higher
void cannot be used as a parameter type
void cannot be used as a parameter type
===errors 8.0===
void cannot be used as a parameter type
void cannot be used as a parameter type
void cannot be used as a parameter type
void cannot be used as a parameter type
===errors >=8.1===
void cannot be used as a parameter type
never cannot be used as a parameter type
void cannot be used as a parameter type
never cannot be used as a parameter type
void cannot be used as a parameter type
void cannot be used as a parameter type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 6
===php_error >=8.0===
PHP Fatal error:  void cannot be used as a parameter type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 24
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "never"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 26,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 31
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 26,
                "end": 37
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
                  "Variable": "c"
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
                    "params": [
                      {
                        "name": {
                          "name": "c",
                          "span": {
                            "start": 62,
                            "end": 64
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 57,
                                "end": 61
                              }
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 61
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 57,
                          "end": 64
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
                  "start": 47,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 68
          }
        }
      },
      "span": {
        "start": 42,
        "end": 69
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
                  "start": 70,
                  "end": 72
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
                          "name": "d",
                          "span": {
                            "start": 84,
                            "end": 86
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "never"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 78,
                                "end": 83
                              }
                            }
                          },
                          "span": {
                            "start": 78,
                            "end": 83
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 78,
                          "end": 86
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 91,
                        "end": 92
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 75,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 92
          }
        }
      },
      "span": {
        "start": 70,
        "end": 93
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 100,
              "end": 101
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
                    "name": "__construct",
                    "span": {
                      "start": 124,
                      "end": 135
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 148,
                          "end": 150
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "void"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 143,
                              "end": 147
                            }
                          }
                        },
                        "span": {
                          "start": 143,
                          "end": 147
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 136,
                        "end": 150
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 108,
                "end": 154
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 175,
                      "end": 176
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 181,
                          "end": 183
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 177,
                              "end": 180
                            }
                          }
                        },
                        "span": {
                          "start": 177,
                          "end": 180
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 177,
                        "end": 183
                      }
                    },
                    {
                      "name": {
                        "name": "g",
                        "span": {
                          "start": 191,
                          "end": 193
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "void"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 185,
                              "end": 189
                            }
                          }
                        },
                        "span": {
                          "start": 185,
                          "end": 189
                        }
                      },
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 185,
                        "end": 193
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 197
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 94,
        "end": 199
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 199
  }
}
