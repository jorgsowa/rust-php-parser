===description===
Fuzzer crash: an unterminated double-quoted string ending in the two UTF-8 bytes of U+05C7.
===source===
<?<?php clas$x"he = [tphp ׇ
===errors <=7.4===
unterminated string literal
expected ';' after expression
expected ';' after expression
expected ';' after expression
===errors >=8.0===
unexpected character 0x12
unterminated string literal
expected ';' after expression
expected ';' after expression
expected ';' after expression
===php_error <=7.4===
PHP Warning:  Unexpected character in input:  '' (ASCII=18) state=0 in Standard input code on line 1
PHP Parse error:  syntax error, unexpected '$x' (T_VARIABLE) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected character 0x12 in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "<?"
      },
      "span": {
        "start": 0,
        "end": 2
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "clas"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 8,
                "end": 12
              }
            }
          },
          "span": {
            "start": 8,
            "end": 12
          }
        }
      },
      "span": {
        "start": 8,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "x"
          },
          "span": {
            "start": 13,
            "end": 15
          }
        }
      },
      "span": {
        "start": 13,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "he = [tphp ׇ"
          },
          "span": {
            "start": 15,
            "end": 29
          }
        }
      },
      "span": {
        "start": 15,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
