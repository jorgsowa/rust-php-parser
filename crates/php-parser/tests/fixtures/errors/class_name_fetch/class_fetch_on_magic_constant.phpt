===source===
<?php
namespace X;
echo (__NAMESPACE__)::class;
function f() { echo (__FUNCTION__)::class; }
class A {
    function f() {
        echo (__METHOD__)::class;
        echo (__CLASS__)::class;
        $f = function () { echo (__CLASS__)::class; };
    }
}
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on string
Cannot use "::class" on string
Cannot use "::class" on string
Cannot use "::class" on string
Cannot use "::class" on string
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 3
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type string in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on string in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "X"
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
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "MagicConst": "Namespace"
                      },
                      "span": {
                        "start": 25,
                        "end": 38
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 39
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 41,
                    "end": 46
                  }
                }
              }
            },
            "span": {
              "start": 24,
              "end": 46
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 47
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 57,
              "end": 58
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "MagicConst": "Function"
                              },
                              "span": {
                                "start": 69,
                                "end": 81
                              }
                            }
                          },
                          "span": {
                            "start": 68,
                            "end": 82
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 84,
                            "end": 89
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 89
                    }
                  }
                ]
              },
              "span": {
                "start": 63,
                "end": 90
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 48,
        "end": 92
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 99,
              "end": 100
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
                      "start": 116,
                      "end": 117
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Parenthesized": {
                                      "kind": {
                                        "MagicConst": "Method"
                                      },
                                      "span": {
                                        "start": 136,
                                        "end": 146
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 135,
                                    "end": 147
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "class"
                                  },
                                  "span": {
                                    "start": 149,
                                    "end": 154
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 135,
                              "end": 154
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 130,
                        "end": 155
                      }
                    },
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Parenthesized": {
                                      "kind": {
                                        "MagicConst": "Class"
                                      },
                                      "span": {
                                        "start": 170,
                                        "end": 179
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 169,
                                    "end": 180
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "class"
                                  },
                                  "span": {
                                    "start": 182,
                                    "end": 187
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 169,
                              "end": 187
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 164,
                        "end": 188
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
                                  "start": 197,
                                  "end": 199
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Closure": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [],
                                    "use_vars": [],
                                    "return_type": null,
                                    "body": [
                                      {
                                        "kind": {
                                          "Echo": [
                                            {
                                              "kind": {
                                                "ClassConstAccess": {
                                                  "class": {
                                                    "kind": {
                                                      "Parenthesized": {
                                                        "kind": {
                                                          "MagicConst": "Class"
                                                        },
                                                        "span": {
                                                          "start": 222,
                                                          "end": 231
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 221,
                                                      "end": 232
                                                    }
                                                  },
                                                  "member": {
                                                    "kind": {
                                                      "Identifier": "class"
                                                    },
                                                    "span": {
                                                      "start": 234,
                                                      "end": 239
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 221,
                                                "end": 239
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 216,
                                          "end": 240
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 202,
                                  "end": 242
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 197,
                            "end": 242
                          }
                        }
                      },
                      "span": {
                        "start": 197,
                        "end": 243
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 107,
                "end": 249
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 93,
        "end": 251
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 251
  }
}
