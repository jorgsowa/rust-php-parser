===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A extends B { const C = self::class; public $p = self::X; function f(): static { return new static(parent::g(), self::$x, static::h(), $x instanceof self); } }
===errors <=7.4===
'static type' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "value": {
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
                                "start": 36,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 36,
                            "end": 40
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 42,
                            "end": 47
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 56,
                      "end": 58
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
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
                                "start": 61,
                                "end": 65
                              }
                            }
                          },
                          "span": {
                            "start": 61,
                            "end": 65
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "X"
                          },
                          "span": {
                            "start": 67,
                            "end": 68
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 61,
                      "end": 68
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 68
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 79,
                      "end": 80
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 84,
                          "end": 90
                        }
                      }
                    },
                    "span": {
                      "start": 84,
                      "end": 90
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "static"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 104,
                                      "end": 110
                                    }
                                  }
                                },
                                "span": {
                                  "start": 104,
                                  "end": 110
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "StaticMethodCall": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 111,
                                                  "end": 117
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 111,
                                              "end": 117
                                            }
                                          },
                                          "method": {
                                            "kind": {
                                              "Identifier": "g"
                                            },
                                            "span": {
                                              "start": 119,
                                              "end": 120
                                            }
                                          },
                                          "args": []
                                        }
                                      },
                                      "span": {
                                        "start": 111,
                                        "end": 122
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 111,
                                    "end": 122
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "StaticPropertyAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "self"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 124,
                                                  "end": 128
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 124,
                                              "end": 128
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "x"
                                            },
                                            "span": {
                                              "start": 130,
                                              "end": 132
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 124,
                                        "end": 132
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 124,
                                    "end": 132
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "StaticMethodCall": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "static"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 134,
                                                  "end": 140
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 134,
                                              "end": 140
                                            }
                                          },
                                          "method": {
                                            "kind": {
                                              "Identifier": "h"
                                            },
                                            "span": {
                                              "start": 142,
                                              "end": 143
                                            }
                                          },
                                          "args": []
                                        }
                                      },
                                      "span": {
                                        "start": 134,
                                        "end": 145
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 134,
                                    "end": 145
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Variable": "x"
                                            },
                                            "span": {
                                              "start": 147,
                                              "end": 149
                                            }
                                          },
                                          "op": "Instanceof",
                                          "right": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "self"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 161,
                                                  "end": 165
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 161,
                                              "end": 165
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 147,
                                        "end": 165
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 147,
                                    "end": 165
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 100,
                            "end": 166
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 167
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 169
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 171
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 171
  }
}
