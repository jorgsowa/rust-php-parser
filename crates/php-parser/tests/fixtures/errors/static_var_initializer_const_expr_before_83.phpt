===source===
<?php
function f() {
    static $a = self::B, $b = parent::B, $c = self::class;
    static $d = static::B;
    static $e = foo();
    static $f = new A;
}
class A {
    function g() {
        static $x = parent::B;
    }
}
===errors 8.0===
"static::" is not allowed in compile-time constants
Constant expression contains invalid operations
'new in initializers' requires PHP 8.1 or higher
Cannot use "self" when no class scope is active
===errors 8.1-8.2===
"static::" is not allowed in compile-time constants
Constant expression contains invalid operations
Cannot use "self" when no class scope is active
===errors >=8.3===
Cannot use "self" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when current class scope has no parent
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
===ast >=8.0===
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
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "self"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 37,
                                  "end": 41
                                }
                              }
                            },
                            "span": {
                              "start": 37,
                              "end": 41
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "B"
                            },
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 44
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 44
                    }
                  },
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 46,
                        "end": 48
                      }
                    },
                    "default": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "parent"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 51,
                                  "end": 57
                                }
                              }
                            },
                            "span": {
                              "start": 51,
                              "end": 57
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "B"
                            },
                            "span": {
                              "start": 59,
                              "end": 60
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 60
                      }
                    },
                    "span": {
                      "start": 46,
                      "end": 60
                    }
                  },
                  {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 62,
                        "end": 64
                      }
                    },
                    "default": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "self"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 67,
                                  "end": 71
                                }
                              }
                            },
                            "span": {
                              "start": 67,
                              "end": 71
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 73,
                              "end": 78
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 78
                      }
                    },
                    "span": {
                      "start": 62,
                      "end": 78
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 79
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "d",
                      "span": {
                        "start": 91,
                        "end": 93
                      }
                    },
                    "default": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "static"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 96,
                                  "end": 102
                                }
                              }
                            },
                            "span": {
                              "start": 96,
                              "end": 102
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "B"
                            },
                            "span": {
                              "start": 104,
                              "end": 105
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 96,
                        "end": 105
                      }
                    },
                    "span": {
                      "start": 91,
                      "end": 105
                    }
                  }
                ]
              },
              "span": {
                "start": 84,
                "end": 106
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "e",
                      "span": {
                        "start": 118,
                        "end": 120
                      }
                    },
                    "default": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 123,
                                  "end": 126
                                }
                              }
                            },
                            "span": {
                              "start": 123,
                              "end": 126
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 123,
                        "end": 128
                      }
                    },
                    "span": {
                      "start": 118,
                      "end": 128
                    }
                  }
                ]
              },
              "span": {
                "start": 111,
                "end": 129
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 141,
                        "end": 143
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 150,
                                  "end": 151
                                }
                              }
                            },
                            "span": {
                              "start": 150,
                              "end": 151
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 146,
                        "end": 151
                      }
                    },
                    "span": {
                      "start": 141,
                      "end": 151
                    }
                  }
                ]
              },
              "span": {
                "start": 134,
                "end": 152
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
        "end": 154
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 161,
              "end": 162
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
                    "name": "g",
                    "span": {
                      "start": 178,
                      "end": 179
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "x",
                              "span": {
                                "start": 199,
                                "end": 201
                              }
                            },
                            "default": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "parent"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 204,
                                          "end": 210
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 204,
                                      "end": 210
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "B"
                                    },
                                    "span": {
                                      "start": 212,
                                      "end": 213
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 204,
                                "end": 213
                              }
                            },
                            "span": {
                              "start": 199,
                              "end": 213
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 192,
                        "end": 214
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 169,
                "end": 220
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 155,
        "end": 222
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 222
  }
}
