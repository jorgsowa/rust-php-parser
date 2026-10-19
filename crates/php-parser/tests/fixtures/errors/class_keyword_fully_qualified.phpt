===source===
<?php
\self::f();
new \parent;
$a instanceof \static;
echo \self::X, \parent::$y;
function f(\self $a): \static {}
class A {
    public \parent $p;
    const X = \self::Y;
    function m($a = \self::X) {}
}
===errors===
'\self' is an invalid class name
'\static' is an invalid class name
'\parent' is an invalid class name
'\self' is an invalid class name
'\parent' is an invalid class name
'\static' is an invalid class name
'\self' is an invalid class name
'\parent' is an invalid class name
'\self' is an invalid class name
'\self' is an invalid class name
===php_error===
PHP Fatal error:  '\self' is an invalid class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "self"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 6,
                      "end": 11
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "method": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "parent"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 22,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 29
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 18,
            "end": 29
          }
        }
      },
      "span": {
        "start": 18,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 31,
                  "end": 33
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "static"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 45,
                      "end": 52
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 52
          }
        }
      },
      "span": {
        "start": 31,
        "end": 53
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
                    "Name": {
                      "parts": [
                        "self"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 59,
                        "end": 64
                      }
                    }
                  },
                  "span": {
                    "start": 59,
                    "end": 64
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "X"
                  },
                  "span": {
                    "start": 66,
                    "end": 67
                  }
                }
              }
            },
            "span": {
              "start": 59,
              "end": 67
            }
          },
          {
            "kind": {
              "StaticPropertyAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "parent"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 69,
                        "end": 76
                      }
                    }
                  },
                  "span": {
                    "start": 69,
                    "end": 76
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "y"
                  },
                  "span": {
                    "start": 78,
                    "end": 80
                  }
                }
              }
            },
            "span": {
              "start": 69,
              "end": 80
            }
          }
        ]
      },
      "span": {
        "start": 54,
        "end": 81
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 91,
              "end": 92
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 99,
                  "end": 101
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 93,
                      "end": 98
                    }
                  }
                },
                "span": {
                  "start": 93,
                  "end": 98
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 93,
                "end": 101
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "static"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 104,
                  "end": 111
                }
              }
            },
            "span": {
              "start": 104,
              "end": 111
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 82,
        "end": 114
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 121,
              "end": 122
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
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 144,
                      "end": 146
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 136,
                          "end": 143
                        }
                      }
                    },
                    "span": {
                      "start": 136,
                      "end": 143
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 129,
                "end": 146
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 158,
                      "end": 159
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
                              "kind": "FullyQualified",
                              "span": {
                                "start": 162,
                                "end": 167
                              }
                            }
                          },
                          "span": {
                            "start": 162,
                            "end": 167
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "Y"
                          },
                          "span": {
                            "start": 169,
                            "end": 170
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 162,
                      "end": 170
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 152,
                "end": 171
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 185,
                      "end": 186
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 187,
                          "end": 189
                        }
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
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 192,
                                    "end": 197
                                  }
                                }
                              },
                              "span": {
                                "start": 192,
                                "end": 197
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "X"
                              },
                              "span": {
                                "start": 199,
                                "end": 200
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 192,
                          "end": 200
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 187,
                        "end": 200
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 176,
                "end": 204
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 115,
        "end": 206
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 206
  }
}
