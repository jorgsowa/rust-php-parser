===source===
<?php
if (1) { const Z = 3; }
===errors===
'const' declarations can only be used at the outermost scope
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'const' (T_CONST) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 10,
              "end": 11
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Const": [
                      {
                        "name": {
                          "name": "Z",
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        },
                        "value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 25,
                            "end": 26
                          }
                        },
                        "attributes": [],
                        "span": {
                          "start": 21,
                          "end": 26
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 15,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 13,
              "end": 29
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
