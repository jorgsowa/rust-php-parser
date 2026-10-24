===source===
<?php if (1) { __halt_compiler() ?>x<?php } echo 1;
===errors===
__HALT_COMPILER() can only be used from the outermost scope
===php_error===
PHP Fatal error:  __HALT_COMPILER() can only be used from the outermost scope in Standard input code on line 1
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
                    "HaltCompiler": ""
                  },
                  "span": {
                    "start": 15,
                    "end": 32
                  }
                },
                {
                  "kind": {
                    "InlineHtml": "x"
                  },
                  "span": {
                    "start": 35,
                    "end": 36
                  }
                }
              ]
            },
            "span": {
              "start": 13,
              "end": 43
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 49,
              "end": 50
            }
          }
        ]
      },
      "span": {
        "start": 44,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
