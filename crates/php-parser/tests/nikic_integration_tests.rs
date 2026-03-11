mod common;

// error handling
nikic_test!(
    nikic_errorhandling_eoferror_1,
    "errorHandling/eofError_1.php",
    errors
);
nikic_test!(
    nikic_errorhandling_eoferror_2,
    "errorHandling/eofError_2.php",
    errors
);
nikic_test!(
    nikic_errorhandling_lexererrors_1,
    "errorHandling/lexerErrors_1.php"
);
nikic_test!(
    nikic_errorhandling_lexererrors_5,
    "errorHandling/lexerErrors_5.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_1,
    "errorHandling/recovery_1.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_2,
    "errorHandling/recovery_2.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_3,
    "errorHandling/recovery_3.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_4,
    "errorHandling/recovery_4.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_5,
    "errorHandling/recovery_5.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_6,
    "errorHandling/recovery_6.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_7,
    "errorHandling/recovery_7.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_8,
    "errorHandling/recovery_8.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_9,
    "errorHandling/recovery_9.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_10,
    "errorHandling/recovery_10.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_11,
    "errorHandling/recovery_11.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_12,
    "errorHandling/recovery_12.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_13,
    "errorHandling/recovery_13.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_14,
    "errorHandling/recovery_14.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_15,
    "errorHandling/recovery_15.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_16,
    "errorHandling/recovery_16.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_17,
    "errorHandling/recovery_17.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_18,
    "errorHandling/recovery_18.php"
);
nikic_test!(
    nikic_errorhandling_recovery_19,
    "errorHandling/recovery_19.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_20,
    "errorHandling/recovery_20.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_21,
    "errorHandling/recovery_21.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_22,
    "errorHandling/recovery_22.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_23,
    "errorHandling/recovery_23.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_24,
    "errorHandling/recovery_24.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_25,
    "errorHandling/recovery_25.php",
    errors
);
nikic_test!(
    nikic_errorhandling_recovery_26,
    "errorHandling/recovery_26.php",
    errors
);

// expr
nikic_test!(
    nikic_expr_alternative_array_syntax_1,
    "expr/alternative_array_syntax_1.php"
);
nikic_test!(
    nikic_expr_alternative_array_syntax_2,
    "expr/alternative_array_syntax_2.php"
);
nikic_test!(nikic_expr_arraydef, "expr/arrayDef.php");
nikic_test!(nikic_expr_arraydestructuring, "expr/arrayDestructuring.php");
nikic_test!(
    nikic_expr_arrayemptyelemens,
    "expr/arrayEmptyElemens.php",
    errors
);
nikic_test!(nikic_expr_arrayspread, "expr/arraySpread.php");
nikic_test!(nikic_expr_arrow_function, "expr/arrow_function.php");
nikic_test!(nikic_expr_assign, "expr/assign.php");
nikic_test!(nikic_expr_assignnewbyref_1, "expr/assignNewByRef_1.php");
nikic_test!(nikic_expr_assignnewbyref_2, "expr/assignNewByRef_2.php");
nikic_test!(nikic_expr_cast, "expr/cast.php", errors);
nikic_test!(nikic_expr_clone, "expr/clone.php");
nikic_test!(nikic_expr_closure, "expr/closure.php");
nikic_test!(
    nikic_expr_closure_use_trailing_comma,
    "expr/closure_use_trailing_comma.php"
);
nikic_test!(nikic_expr_comparison, "expr/comparison.php");
nikic_test!(nikic_expr_concatprecedence_1, "expr/concatPrecedence_1.php");
nikic_test!(nikic_expr_concatprecedence_2, "expr/concatPrecedence_2.php");
nikic_test!(nikic_expr_constant_expr, "expr/constant_expr.php");
nikic_test!(nikic_expr_dynamicclassconst, "expr/dynamicClassConst.php");
nikic_test!(nikic_expr_errorsuppress, "expr/errorSuppress.php");
nikic_test!(nikic_expr_exit, "expr/exit.php");
nikic_test!(nikic_expr_exprinisset, "expr/exprInIsset.php");
nikic_test!(nikic_expr_exprinlist, "expr/exprInList.php");
nikic_test!(nikic_expr_fetchandcall_args, "expr/fetchAndCall/args.php");
nikic_test!(
    nikic_expr_fetchandcall_constfetch,
    "expr/fetchAndCall/constFetch.php"
);
nikic_test!(
    nikic_expr_fetchandcall_constantderef,
    "expr/fetchAndCall/constantDeref.php"
);
nikic_test!(
    nikic_expr_fetchandcall_funccall,
    "expr/fetchAndCall/funcCall.php"
);
nikic_test!(
    nikic_expr_fetchandcall_namedargs,
    "expr/fetchAndCall/namedArgs.php"
);
nikic_test!(
    nikic_expr_fetchandcall_newderef,
    "expr/fetchAndCall/newDeref.php"
);
nikic_test!(
    nikic_expr_fetchandcall_objectaccess,
    "expr/fetchAndCall/objectAccess.php"
);
nikic_test!(
    nikic_expr_fetchandcall_simplearrayaccess,
    "expr/fetchAndCall/simpleArrayAccess.php"
);
nikic_test!(
    nikic_expr_fetchandcall_staticcall,
    "expr/fetchAndCall/staticCall.php"
);
nikic_test!(
    nikic_expr_fetchandcall_staticpropertyfetch,
    "expr/fetchAndCall/staticPropertyFetch.php"
);
nikic_test!(
    nikic_expr_firstclasscallables,
    "expr/firstClassCallables.php"
);
nikic_test!(nikic_expr_includeandeval, "expr/includeAndEval.php");
nikic_test!(nikic_expr_issetandempty, "expr/issetAndEmpty.php");
nikic_test!(
    nikic_expr_keywordsinnamespacedname,
    "expr/keywordsInNamespacedName.php"
);
nikic_test!(nikic_expr_listreferences, "expr/listReferences.php");
nikic_test!(nikic_expr_listwithkeys, "expr/listWithKeys.php");
nikic_test!(nikic_expr_logic, "expr/logic.php");
nikic_test!(nikic_expr_match_1, "expr/match_1.php");
nikic_test!(nikic_expr_match_2, "expr/match_2.php");
nikic_test!(nikic_expr_match_3, "expr/match_3.php");
nikic_test!(nikic_expr_match_4, "expr/match_4.php");
nikic_test!(nikic_expr_match_5, "expr/match_5.php");
nikic_test!(nikic_expr_math, "expr/math.php");
nikic_test!(nikic_expr_new, "expr/new.php");
nikic_test!(nikic_expr_newderef, "expr/newDeref.php");
nikic_test!(
    nikic_expr_newwithoutclass,
    "expr/newWithoutClass.php",
    errors
);
nikic_test!(nikic_expr_nullsafe, "expr/nullsafe.php");
nikic_test!(nikic_expr_pipe, "expr/pipe.php");
nikic_test!(nikic_expr_print, "expr/print.php");
nikic_test!(nikic_expr_shellexec, "expr/shellExec.php");
nikic_test!(nikic_expr_ternaryandcoalesce, "expr/ternaryAndCoalesce.php");
nikic_test!(nikic_expr_throw, "expr/throw.php");
nikic_test!(nikic_expr_trailingcommas, "expr/trailingCommas.php");
nikic_test!(nikic_expr_uvs_constderef, "expr/uvs/constDeref.php");
nikic_test!(
    nikic_expr_uvs_globalnonsimplevarerror,
    "expr/uvs/globalNonSimpleVarError.php",
    errors
);
nikic_test!(nikic_expr_uvs_indirectcall, "expr/uvs/indirectCall.php");
nikic_test!(nikic_expr_uvs_isset, "expr/uvs/isset.php");
nikic_test!(nikic_expr_uvs_misc, "expr/uvs/misc.php");
nikic_test!(nikic_expr_uvs_new, "expr/uvs/new.php");
nikic_test!(
    nikic_expr_uvs_newinstanceofexpr,
    "expr/uvs/newInstanceofExpr.php"
);
nikic_test!(nikic_expr_uvs_staticproperty, "expr/uvs/staticProperty.php");
nikic_test!(nikic_expr_varvarpos, "expr/varVarPos.php");
nikic_test!(nikic_expr_variable, "expr/variable.php");

// misc
nikic_test!(nikic_blockcomments, "blockComments.php");
nikic_test!(nikic_commentatendofclass, "commentAtEndOfClass.php");
nikic_test!(nikic_comments_1, "comments_1.php");
nikic_test!(nikic_comments_2, "comments_2.php");
nikic_test!(nikic_comments_3, "comments_3.php");
nikic_test!(nikic_emptyfile, "emptyFile.php");
nikic_test!(nikic_formattingattributes, "formattingAttributes.php");
nikic_test!(nikic_noppositions_1, "nopPositions_1.php");
nikic_test!(nikic_noppositions_2, "nopPositions_2.php");
nikic_test!(nikic_semireserved, "semiReserved.php");

// scalar
nikic_test!(nikic_scalar_constantstring, "scalar/constantString.php");
nikic_test!(nikic_scalar_docstring, "scalar/docString.php");
nikic_test!(nikic_scalar_encapsedstring, "scalar/encapsedString.php");
nikic_test!(nikic_scalar_explicitoctal, "scalar/explicitOctal.php");
nikic_test!(nikic_scalar_float, "scalar/float.php");
nikic_test!(nikic_scalar_invalidoctal_1, "scalar/invalidOctal_1.php");
nikic_test!(nikic_scalar_invalidoctal_2, "scalar/invalidOctal_2.php");
nikic_test!(nikic_scalar_magicconst, "scalar/magicConst.php");
nikic_test!(
    nikic_scalar_numberseparators,
    "scalar/numberSeparators.php",
    errors
);
nikic_test!(nikic_scalar_unicodeescape_1, "scalar/unicodeEscape_1.php");
nikic_test!(nikic_scalar_unicodeescape_2, "scalar/unicodeEscape_2.php");
nikic_test!(nikic_scalar_unicodeescape_3, "scalar/unicodeEscape_3.php");

// stmt
nikic_test!(nikic_stmt_attributes, "stmt/attributes.php");
nikic_test!(nikic_stmt_blocklessstatement, "stmt/blocklessStatement.php");
nikic_test!(nikic_stmt_class_abstract, "stmt/class/abstract.php");
nikic_test!(nikic_stmt_class_anonymous, "stmt/class/anonymous.php");
nikic_test!(
    nikic_stmt_class_asymmetric_visibility_1,
    "stmt/class/asymmetric_visibility_1.php"
);
nikic_test!(
    nikic_stmt_class_asymmetric_visibility_2,
    "stmt/class/asymmetric_visibility_2.php"
);
nikic_test!(
    nikic_stmt_class_class_position_1,
    "stmt/class/class_position_1.php"
);
nikic_test!(
    nikic_stmt_class_class_position_2,
    "stmt/class/class_position_2.php"
);
nikic_test!(
    nikic_stmt_class_class_position_3,
    "stmt/class/class_position_3.php"
);
nikic_test!(nikic_stmt_class_conditional, "stmt/class/conditional.php");
nikic_test!(
    nikic_stmt_class_constmodifiererrors_1,
    "stmt/class/constModifierErrors_1.php",
    errors
);
nikic_test!(
    nikic_stmt_class_constmodifiererrors_2,
    "stmt/class/constModifierErrors_2.php",
    errors
);
nikic_test!(
    nikic_stmt_class_constmodifiererrors_3,
    "stmt/class/constModifierErrors_3.php",
    errors
);
nikic_test!(
    nikic_stmt_class_constmodifiererrors_4,
    "stmt/class/constModifierErrors_4.php",
    errors
);
nikic_test!(
    nikic_stmt_class_constmodifiers,
    "stmt/class/constModifiers.php"
);
nikic_test!(nikic_stmt_class_enum, "stmt/class/enum.php", errors);
nikic_test!(
    nikic_stmt_class_enum_with_string,
    "stmt/class/enum_with_string.php"
);
nikic_test!(nikic_stmt_class_final, "stmt/class/final.php");
nikic_test!(
    nikic_stmt_class_implicitpublic,
    "stmt/class/implicitPublic.php"
);
nikic_test!(nikic_stmt_class_interface, "stmt/class/interface.php");
nikic_test!(
    nikic_stmt_class_modifier_error_1,
    "stmt/class/modifier_error_1.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_2,
    "stmt/class/modifier_error_2.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_3,
    "stmt/class/modifier_error_3.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_4,
    "stmt/class/modifier_error_4.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_5,
    "stmt/class/modifier_error_5.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_6,
    "stmt/class/modifier_error_6.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_7,
    "stmt/class/modifier_error_7.php",
    errors
);
nikic_test!(
    nikic_stmt_class_modifier_error_8,
    "stmt/class/modifier_error_8.php",
    errors
);
nikic_test!(nikic_stmt_class_name_1, "stmt/class/name_1.php", errors);
nikic_test!(nikic_stmt_class_name_2, "stmt/class/name_2.php", errors);
nikic_test!(nikic_stmt_class_name_3, "stmt/class/name_3.php", errors);
nikic_test!(nikic_stmt_class_name_4, "stmt/class/name_4.php", errors);
nikic_test!(nikic_stmt_class_name_5, "stmt/class/name_5.php", errors);
nikic_test!(nikic_stmt_class_name_6, "stmt/class/name_6.php", errors);
nikic_test!(nikic_stmt_class_name_7, "stmt/class/name_7.php", errors);
nikic_test!(nikic_stmt_class_name_8, "stmt/class/name_8.php", errors);
nikic_test!(nikic_stmt_class_name_9, "stmt/class/name_9.php", errors);
nikic_test!(nikic_stmt_class_name_10, "stmt/class/name_10.php", errors);
nikic_test!(nikic_stmt_class_name_11, "stmt/class/name_11.php", errors);
nikic_test!(nikic_stmt_class_name_12, "stmt/class/name_12.php", errors);
nikic_test!(nikic_stmt_class_name_13, "stmt/class/name_13.php", errors);
nikic_test!(nikic_stmt_class_name_14, "stmt/class/name_14.php", errors);
nikic_test!(nikic_stmt_class_name_15, "stmt/class/name_15.php", errors);
nikic_test!(nikic_stmt_class_php4style, "stmt/class/php4Style.php");
nikic_test!(
    nikic_stmt_class_propertytypes,
    "stmt/class/propertyTypes.php"
);
nikic_test!(
    nikic_stmt_class_property_hooks_1,
    "stmt/class/property_hooks_1.php"
);
nikic_test!(
    nikic_stmt_class_property_hooks_2,
    "stmt/class/property_hooks_2.php"
);
nikic_test!(
    nikic_stmt_class_property_hooks_3,
    "stmt/class/property_hooks_3.php"
);
nikic_test!(
    nikic_stmt_class_property_hooks_4,
    "stmt/class/property_hooks_4.php",
    errors
);
nikic_test!(
    nikic_stmt_class_property_hooks_5,
    "stmt/class/property_hooks_5.php",
    errors
);
nikic_test!(
    nikic_stmt_class_property_hooks_6,
    "stmt/class/property_hooks_6.php",
    errors
);
nikic_test!(
    nikic_stmt_class_property_hooks_7,
    "stmt/class/property_hooks_7.php",
    errors
);
nikic_test!(
    nikic_stmt_class_property_modifiers,
    "stmt/class/property_modifiers.php"
);
nikic_test!(
    nikic_stmt_class_property_promotion,
    "stmt/class/property_promotion.php"
);
nikic_test!(nikic_stmt_class_readonly_1, "stmt/class/readonly_1.php");
nikic_test!(nikic_stmt_class_readonly_2, "stmt/class/readonly_2.php");
nikic_test!(
    nikic_stmt_class_readonlyanonyous,
    "stmt/class/readonlyAnonyous.php"
);
nikic_test!(
    nikic_stmt_class_readonlyasclassname_1,
    "stmt/class/readonlyAsClassName_1.php",
    errors
);
nikic_test!(
    nikic_stmt_class_readonlyasclassname_2,
    "stmt/class/readonlyAsClassName_2.php",
    errors
);
nikic_test!(
    nikic_stmt_class_readonlymethod,
    "stmt/class/readonlyMethod.php"
);
nikic_test!(
    nikic_stmt_class_shortechoasidentifier,
    "stmt/class/shortEchoAsIdentifier.php",
    errors
);
nikic_test!(nikic_stmt_class_simple, "stmt/class/simple.php");
nikic_test!(
    nikic_stmt_class_staticmethod_1,
    "stmt/class/staticMethod_1.php"
);
nikic_test!(
    nikic_stmt_class_staticmethod_2,
    "stmt/class/staticMethod_2.php"
);
nikic_test!(
    nikic_stmt_class_staticmethod_3,
    "stmt/class/staticMethod_3.php"
);
nikic_test!(
    nikic_stmt_class_staticmethod_4,
    "stmt/class/staticMethod_4.php"
);
nikic_test!(
    nikic_stmt_class_staticmethod_5,
    "stmt/class/staticMethod_5.php"
);
nikic_test!(
    nikic_stmt_class_staticmethod_6,
    "stmt/class/staticMethod_6.php"
);
nikic_test!(nikic_stmt_class_statictype, "stmt/class/staticType.php");
nikic_test!(nikic_stmt_class_trait, "stmt/class/trait.php");
nikic_test!(
    nikic_stmt_class_typedconstants,
    "stmt/class/typedConstants.php"
);
nikic_test!(nikic_stmt_const, "stmt/const.php", errors);
nikic_test!(nikic_stmt_controlflow, "stmt/controlFlow.php");
nikic_test!(nikic_stmt_declare, "stmt/declare.php");
nikic_test!(nikic_stmt_echo, "stmt/echo.php");
nikic_test!(
    nikic_stmt_function_builtintypedeclarations,
    "stmt/function/builtinTypeDeclarations.php"
);
nikic_test!(nikic_stmt_function_byref, "stmt/function/byRef.php");
nikic_test!(
    nikic_stmt_function_clone_function,
    "stmt/function/clone_function.php"
);
nikic_test!(
    nikic_stmt_function_conditional,
    "stmt/function/conditional.php"
);
nikic_test!(
    nikic_stmt_function_defaultvalues,
    "stmt/function/defaultValues.php"
);
nikic_test!(
    nikic_stmt_function_disjointnormalformtypes,
    "stmt/function/disjointNormalFormTypes.php"
);
nikic_test!(
    nikic_stmt_function_exit_die_function,
    "stmt/function/exit_die_function.php"
);
nikic_test!(
    nikic_stmt_function_intersectiontypes,
    "stmt/function/intersectionTypes.php"
);
nikic_test!(nikic_stmt_function_nevertype, "stmt/function/neverType.php");
nikic_test!(
    nikic_stmt_function_nullfalsetruetypes_1,
    "stmt/function/nullFalseTrueTypes_1.php"
);
nikic_test!(
    nikic_stmt_function_nullfalsetruetypes_2,
    "stmt/function/nullFalseTrueTypes_2.php"
);
nikic_test!(
    nikic_stmt_function_nullabletypes,
    "stmt/function/nullableTypes.php"
);
nikic_test!(
    nikic_stmt_function_parameters_trailing_comma_1,
    "stmt/function/parameters_trailing_comma_1.php"
);
nikic_test!(
    nikic_stmt_function_parameters_trailing_comma_2,
    "stmt/function/parameters_trailing_comma_2.php"
);
nikic_test!(
    nikic_stmt_function_parameters_trailing_comma_3,
    "stmt/function/parameters_trailing_comma_3.php"
);
nikic_test!(
    nikic_stmt_function_readonlyfunction,
    "stmt/function/readonlyFunction.php"
);
nikic_test!(
    nikic_stmt_function_returntypes,
    "stmt/function/returnTypes.php"
);
nikic_test!(
    nikic_stmt_function_specialvars,
    "stmt/function/specialVars.php"
);
nikic_test!(
    nikic_stmt_function_typedeclarations,
    "stmt/function/typeDeclarations.php"
);
nikic_test!(
    nikic_stmt_function_typeversions_1,
    "stmt/function/typeVersions_1.php"
);
nikic_test!(
    nikic_stmt_function_typeversions_2,
    "stmt/function/typeVersions_2.php"
);
nikic_test!(
    nikic_stmt_function_typeversions_3,
    "stmt/function/typeVersions_3.php"
);
nikic_test!(
    nikic_stmt_function_typeversions_4,
    "stmt/function/typeVersions_4.php"
);
nikic_test!(
    nikic_stmt_function_typeversions_5,
    "stmt/function/typeVersions_5.php"
);
nikic_test!(
    nikic_stmt_function_typeversions_6,
    "stmt/function/typeVersions_6.php"
);
nikic_test!(
    nikic_stmt_function_uniontypes,
    "stmt/function/unionTypes.php"
);
nikic_test!(nikic_stmt_function_variadic, "stmt/function/variadic.php");
nikic_test!(
    nikic_stmt_function_variadicdefaultvalue,
    "stmt/function/variadicDefaultValue.php"
);
nikic_test!(nikic_stmt_generator_basic, "stmt/generator/basic.php");
nikic_test!(
    nikic_stmt_generator_yieldprecedence,
    "stmt/generator/yieldPrecedence.php"
);
nikic_test!(
    nikic_stmt_generator_yieldunaryprecedence,
    "stmt/generator/yieldUnaryPrecedence.php"
);
nikic_test!(nikic_stmt_haltcompiler_1, "stmt/haltCompiler_1.php");
nikic_test!(nikic_stmt_haltcompiler_2, "stmt/haltCompiler_2.php");
nikic_test!(nikic_stmt_haltcompiler_3, "stmt/haltCompiler_3.php");
nikic_test!(
    nikic_stmt_haltcompilerinvalidsyntax,
    "stmt/haltCompilerInvalidSyntax.php",
    errors
);
nikic_test!(nikic_stmt_haltcompileroffset, "stmt/haltCompilerOffset.php");
nikic_test!(
    nikic_stmt_haltcompileroutermostscope,
    "stmt/haltCompilerOutermostScope.php",
    errors
);
nikic_test!(nikic_stmt_hashbang, "stmt/hashbang.php");
nikic_test!(nikic_stmt_if, "stmt/if.php");
nikic_test!(nikic_stmt_inlinehtml, "stmt/inlineHTML.php");
nikic_test!(nikic_stmt_loop_do, "stmt/loop/do.php");
nikic_test!(nikic_stmt_loop_for, "stmt/loop/for.php");
nikic_test!(nikic_stmt_loop_foreach, "stmt/loop/foreach.php");
nikic_test!(nikic_stmt_loop_while, "stmt/loop/while.php");
nikic_test!(nikic_stmt_multicatch, "stmt/multiCatch.php");
nikic_test!(nikic_stmt_namespace_alias, "stmt/namespace/alias.php");
nikic_test!(nikic_stmt_namespace_braced, "stmt/namespace/braced.php");
nikic_test!(
    nikic_stmt_namespace_commentafternamespace,
    "stmt/namespace/commentAfterNamespace.php"
);
nikic_test!(nikic_stmt_namespace_groupuse, "stmt/namespace/groupUse.php");
nikic_test!(
    nikic_stmt_namespace_groupuseerrors_1,
    "stmt/namespace/groupUseErrors_1.php",
    errors
);
nikic_test!(
    nikic_stmt_namespace_groupuseerrors_2,
    "stmt/namespace/groupUseErrors_2.php",
    errors
);
nikic_test!(
    nikic_stmt_namespace_groupuseerrors_3,
    "stmt/namespace/groupUseErrors_3.php",
    errors
);
nikic_test!(
    nikic_stmt_namespace_groupusepositions,
    "stmt/namespace/groupUsePositions.php"
);
nikic_test!(
    nikic_stmt_namespace_groupusetrailingcomma,
    "stmt/namespace/groupUseTrailingComma.php"
);
nikic_test!(
    nikic_stmt_namespace_invalidname_1,
    "stmt/namespace/invalidName_1.php",
    errors
);
nikic_test!(
    nikic_stmt_namespace_invalidname_2,
    "stmt/namespace/invalidName_2.php",
    errors
);
nikic_test!(
    nikic_stmt_namespace_invalidname_3,
    "stmt/namespace/invalidName_3.php",
    errors
);
nikic_test!(nikic_stmt_namespace_mix_1, "stmt/namespace/mix_1.php");
nikic_test!(nikic_stmt_namespace_mix_2, "stmt/namespace/mix_2.php");
nikic_test!(nikic_stmt_namespace_name, "stmt/namespace/name.php");
nikic_test!(nikic_stmt_namespace_nested, "stmt/namespace/nested.php");
nikic_test!(
    nikic_stmt_namespace_notbraced,
    "stmt/namespace/notBraced.php"
);
nikic_test!(
    nikic_stmt_namespace_nsafterhashbang,
    "stmt/namespace/nsAfterHashbang.php"
);
nikic_test!(
    nikic_stmt_namespace_outsidestmt_1,
    "stmt/namespace/outsideStmt_1.php"
);
nikic_test!(
    nikic_stmt_namespace_outsidestmt_2,
    "stmt/namespace/outsideStmt_2.php"
);
nikic_test!(
    nikic_stmt_namespace_outsidestmtinvalid_1,
    "stmt/namespace/outsideStmtInvalid_1.php"
);
nikic_test!(
    nikic_stmt_namespace_outsidestmtinvalid_2,
    "stmt/namespace/outsideStmtInvalid_2.php"
);
nikic_test!(
    nikic_stmt_namespace_outsidestmtinvalid_3,
    "stmt/namespace/outsideStmtInvalid_3.php"
);
nikic_test!(nikic_stmt_newininitializer, "stmt/newInInitializer.php");
nikic_test!(nikic_stmt_switch, "stmt/switch.php");
nikic_test!(nikic_stmt_trycatch, "stmt/tryCatch.php");
nikic_test!(
    nikic_stmt_trycatch_without_variable,
    "stmt/tryCatch_without_variable.php"
);
nikic_test!(
    nikic_stmt_trywithoutcatch,
    "stmt/tryWithoutCatch.php",
    errors
);
nikic_test!(nikic_stmt_unset, "stmt/unset.php");
nikic_test!(nikic_stmt_voidcast, "stmt/voidCast.php");
