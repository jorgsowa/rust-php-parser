===source===
<?php

class DemoClass {
	public string $hooked {
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		get => $this->hooked;
		#[DelayedTargetValidation]
		#[NoDiscard] // Does nothing here
		set => $value;
	}
}

$hook = new ReflectionProperty('DemoClass', 'hooked')->getHook(PropertyHookType::Get);
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 4
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "DemoClass",
            "span": {
              "start": 13,
              "end": 22
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
                    "name": "hooked",
                    "span": {
                      "start": 40,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 124,
                                  "end": 129
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "hooked"
                                },
                                "span": {
                                  "start": 131,
                                  "end": 137
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 124,
                            "end": 137
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 54,
                              "end": 77
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 54,
                            "end": 77
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 83,
                              "end": 92
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 83,
                            "end": 92
                          }
                        }
                      ],
                      "span": {
                        "start": 52,
                        "end": 138
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 213,
                            "end": 219
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "DelayedTargetValidation"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 143,
                              "end": 166
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 143,
                            "end": 166
                          }
                        },
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 172,
                              "end": 181
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 172,
                            "end": 181
                          }
                        }
                      ],
                      "span": {
                        "start": 141,
                        "end": 220
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 26,
                "end": 223
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 225
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "hook"
                },
                "span": {
                  "start": 227,
                  "end": 232
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "ReflectionProperty"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 239,
                                  "end": 257
                                }
                              }
                            },
                            "span": {
                              "start": 239,
                              "end": 257
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "DemoClass"
                                  },
                                  "span": {
                                    "start": 258,
                                    "end": 269
                                  }
                                }
                              },
                              "span": {
                                "start": 258,
                                "end": 269
                              }
                            },
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "hooked"
                                  },
                                  "span": {
                                    "start": 271,
                                    "end": 279
                                  }
                                }
                              },
                              "span": {
                                "start": 271,
                                "end": 279
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 235,
                        "end": 280
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "getHook"
                      },
                      "span": {
                        "start": 282,
                        "end": 289
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "PropertyHookType"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 290,
                                        "end": 306
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 290,
                                    "end": 306
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "Get"
                                  },
                                  "span": {
                                    "start": 308,
                                    "end": 311
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 290,
                              "end": 311
                            }
                          }
                        },
                        "span": {
                          "start": 290,
                          "end": 311
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 235,
                  "end": 312
                }
              }
            }
          },
          "span": {
            "start": 227,
            "end": 312
          }
        }
      },
      "span": {
        "start": 227,
        "end": 313
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 313
  }
}
