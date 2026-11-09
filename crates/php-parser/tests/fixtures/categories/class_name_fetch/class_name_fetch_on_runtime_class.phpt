===source===
<?php
class A extends B {
    function f() {
        return [static::class::class, fn() => self::class::class, function () { return parent::class::class; }];
    }
}
trait T { function f() { return self::class::class; } }
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use ::class with dynamic class name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '::' (T_PAAMAYIM_NEKUDOTAYIM), expecting ']' in Standard input code on line 4
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
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 39,
                      "end": 40
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "ClassConstAccess": {
                                        "class": {
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
                                                      "start": 61,
                                                      "end": 67
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 61,
                                                  "end": 67
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "class"
                                                },
                                                "span": {
                                                  "start": 69,
                                                  "end": 74
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 61,
                                            "end": 74
                                          }
                                        },
                                        "member": {
                                          "kind": {
                                            "Identifier": "class"
                                          },
                                          "span": {
                                            "start": 76,
                                            "end": 81
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 61,
                                      "end": 81
                                    }
                                  }
                                },
                                "span": {
                                  "start": 61,
                                  "end": 81
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "ArrowFunction": {
                                        "is_static": false,
                                        "by_ref": false,
                                        "params": [],
                                        "return_type": null,
                                        "body": {
                                          "kind": {
                                            "ClassConstAccess": {
                                              "class": {
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
                                                            "start": 91,
                                                            "end": 95
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 91,
                                                        "end": 95
                                                      }
                                                    },
                                                    "member": {
                                                      "kind": {
                                                        "Identifier": "class"
                                                      },
                                                      "span": {
                                                        "start": 97,
                                                        "end": 102
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 91,
                                                  "end": 102
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "class"
                                                },
                                                "span": {
                                                  "start": 104,
                                                  "end": 109
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 91,
                                            "end": 109
                                          }
                                        },
                                        "attributes": []
                                      }
                                    },
                                    "span": {
                                      "start": 83,
                                      "end": 109
                                    }
                                  }
                                },
                                "span": {
                                  "start": 83,
                                  "end": 109
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
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
                                              "Return": {
                                                "kind": {
                                                  "ClassConstAccess": {
                                                    "class": {
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
                                                                  "start": 132,
                                                                  "end": 138
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 132,
                                                              "end": 138
                                                            }
                                                          },
                                                          "member": {
                                                            "kind": {
                                                              "Identifier": "class"
                                                            },
                                                            "span": {
                                                              "start": 140,
                                                              "end": 145
                                                            }
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 132,
                                                        "end": 145
                                                      }
                                                    },
                                                    "member": {
                                                      "kind": {
                                                        "Identifier": "class"
                                                      },
                                                      "span": {
                                                        "start": 147,
                                                        "end": 152
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 132,
                                                  "end": 152
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 125,
                                              "end": 153
                                            }
                                          }
                                        ],
                                        "attributes": []
                                      }
                                    },
                                    "span": {
                                      "start": 111,
                                      "end": 155
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 155
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 60,
                            "end": 156
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 157
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 163
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 165
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 172,
              "end": 173
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 185,
                      "end": 186
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
                            "ClassConstAccess": {
                              "class": {
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
                                            "start": 198,
                                            "end": 202
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 198,
                                        "end": 202
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "class"
                                      },
                                      "span": {
                                        "start": 204,
                                        "end": 209
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 198,
                                  "end": 209
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "class"
                                },
                                "span": {
                                  "start": 211,
                                  "end": 216
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 198,
                            "end": 216
                          }
                        }
                      },
                      "span": {
                        "start": 191,
                        "end": 217
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 176,
                "end": 219
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 166,
        "end": 221
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 221
  }
}
